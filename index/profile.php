<?php
require_once("database.php");
error_reporting(-1);
ini_set('display_errors', 'On');

join_database();
$tab = select_fields("user");
$new_bool = false;
$detector = 0;
$bool = true;
$var_log = "";
$var_mail ="";
$var_phone = "";
$var_login = "";
$new_tab = select_fields("user");

if (isset($_POST['add_user'])) {
    $hash_key = hash_hmac('md5',htmlentities($_POST['password']), 'secret');
    $user = array ("login" => htmlentities($_POST["login"]), "mail" => htmlentities($_POST["mail"]), "password" => $hash_key, "phone_number" => htmlentities($_POST["phone"]));
    $confirm_password = htmlentities($_POST["confirm_password"]);
    $var_log = $user['login'];
    $var_mail = $user['mail'];
    $var_phone = $user['phone_number'];

    foreach($tab as $v)
	{
	    if($user["login"] == $v["login"]){
		$bool = false;
	    echo "<p class='error_gestion'> Le login existe déjà </p>"; }
	}

	foreach($tab as $v)
	{
		if($user['phone_number'] == $v['phone_number']){
			$bool = false;
			echo "<p class='error_gestion'> Numéro de téléphone déjà pris </p>";
		}
	}
    if($_POST["password"] != $confirm_password){
	$bool = false;
	echo "<p class='error_gestion'> Les mots de passe ne correspondent pas</p>";
        }
	if(!filter_var($user["mail"], FILTER_VALIDATE_EMAIL)){
	    $bool = false;
	echo "<p class='error_gestion'> Mail invalide </p>";
	}
    if($bool == true)
	{
	    $new_id =  insert_fields("user", $user);
	    $new_tab = select_fields("user", $new_id);
	    setcookie("login", $new_tab[0]["login"]);
	    setcookie("password", $new_tab[0]["password"]);
		echo "<p id='inscription'> Inscription réussie ! </p>";
	}
}

if(isset($_POST['connect'])){
    $var_login = htmlentities($_POST["login1"]);
    $new_user = array("login" => htmlentities($_POST["login1"]), "password" => hash_hmac('md5', htmlentities($_POST["password1"]), 'secret'));
	$new_tab = select_fields("user");

foreach($new_tab as $v)
{
    if($new_user["login"] == $v["login"] && hash_equals($v["password"], $new_user["password"]))
    {
	$new_bool = true;
	setcookie("login", $v["login"]);
	setcookie("password", $v["password"]);
	echo "<p id='inscription'>Connexion reussi</p>";
	break;
    }

    else if($new_user["login"] == $v["login"] && hash_equals($new_user["password"], $v["password"]) == false)
    {
	echo "<p class='error_gestion'> Mot de passe incorrect </p>";
	$detector = 1;
	break;
    }
}

if($new_bool == false && $detector == 0)
{
    echo "<p class='error_gestion'>Nom d'utilisateur ou mot de passe incorrect</p>";
}
}
?>

<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <form action="" method="POST">
                <h1>Inscription</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" value="<?= $var_log ?>" required>

				<label><b>Mail</b></label>
				<input type="mail" placeholder="Entrer le mail de l'utilisateur" name="mail" value="<?= $var_mail ?>" required>

				<label><b>Numéro de téléphone</b></label>
				<input type="tel" placeholder="Entrer votre numéro de téléphone" name="phone" value="<?= $var_phone ?>" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

				<label><b>Répéter le mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="confirm_password" required>

                <input type="submit" id='submit' value="S'INSCRIRE" name="add_user">
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
			</div>
		<div id="container2">
			<form action="" method="POST">
			<h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="login1" value="<?= $var_login ?>" required>

				<label><b>Mot de passe</b></label>
				<input type="password" placeholder="Entrer le mot de passe" name="password1" required>

				<input type="submit" id="submit" value="SE CONNECTER" name="connect">
				<?php
				if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
				?>
			</form>
			</div>
    </body>
</html>


