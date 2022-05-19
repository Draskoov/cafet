<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>F and F</title>

    <link rel="icon" type="image/png" href="favicon.png" />

    <link href="https://fr.allfont.net/allfont.css?fonts=futura-bold" rel="stylesheet" type="text/css" />

    <script src="script.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="index.css">
</head>
<?php
if(isset($_POST['logout']))
{
    unset($_COOKIE['login']);
    unset($_COOKIE['password']);
    setcookie('login', '', -1);
    setcookie('password', '', -1);
    $boule = true;
}
?>
<body>
    <div class="container">
    <header class="header">
            <a class="nav" href="menu.php">Nos repas</a>
            <img src="V5.png" style="margin-left: 10%;" sizes="15px">
            <a class="nav" href="profile.php">S'inscrire / Se connecter</a>
            <?php if($boule = false)
            {
            ?> <p style="font-weight:bold;"> Connecté en tant que : <?= $_COOKIE['login'] ?> </p> <?php
            }
            ?>
            <form method="POST" action="<?=$_SERVER['REQUEST_URI']?>">
            <input class="input" type=submit value="Se déconnecter" name="logout">
            </form>
    </header>
    </div>

    <div id="carouselExemple" class="carousel slide" data-ride="carousel" data-interval="5000">

        <ol class="carousel-indicators">
            <li data-target="#carouselExemple" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExemple" data-slide-to="1"></li>
        </ol>


        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="plat1.jpg"
                    class="d-block">
            </div>

            <div class="carousel-item">
                <img src="plat2.jpg"
                    class="d-block">
            </div>

        </div>

        <a href="#carouselExemple" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a href="#carouselExemple" class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>


    <script>
        $('.carousel').carousel({

            pause: "null"

        })
    </script>
    <div class="info">
        <h4 style="padding-top: 3%; padding-bottom: 2%;"> A propos de nous </h4>
        <div class="apropos">
            <img class="image" src="jsp.jpg">     
        <p> Avec son service de restauration rapide en Click and Collect F and F est le restaurant étudiant te proposant de manger sains et de consommer des produits nutritionnellement et gustativement bons préparés par les étudiants de l’école de l'excellence à la française.
                    
                    Avec son slogan “L'Élégance du service rapide”, F and F possède des valeurs importantes basées sur le partage, la proximité, l’audace et la rapidité.
                                        
                    Si tu es gourmand ou en quête de nouvelles saveurs F and F t'ouvre les portes de la cuisine gastronomique à moindre coût !
                    En partenariat avec le restaurant étoilé Le Baron, les comptoirs de F&F vous proposent des plats variés et diététiques dans la cour du château !
                    
                    Fruits de notre imagination et de notre passion, des spécialités inspirées, à mis chemin entre cuisine française et cuisine rapide. Nous sommes fiers de perfectionner vos plats préférés en y apportant de la nouveauté et de la créativité.
    </p> 
    </div></div>
    <footer class="footer">
        <div class="container">
        <div class="row" style="padding-right: 5%;padding-left: 5%;">
            <div class="col-sm-6 col-md-3 item">

                <h3>Fast & Ferrières</h3>
                <p>Restaurant ouvert du Lundi au Vendredi: 11h-14h</p>
            </div>
            <div class="col-sm-6 col-md-3 item">
                <h3>About</h3>
                <ul style="padding-right: 5%">
                    <li>Adresse: 5 Rue Charles Cordier</li>
                </ul>
            </div>
            <div class="col-md-5 item text">
                <!-- <h3>Fast & Ferrières</h3>
                <p>Restaurant ouvert du Lundi au Vendredi: 11h-14h</p> -->
                <ul>
                    <h3>Nos réseaux sociaux</h3>
                    <li class="logo"><img src="insta.png" class="logo"></li>
                    <li class="logo"><img src="fb.png" class="logo"></li>
                    <li class="logo"><img src="tiktok.png" class="logo"></li>
                </ul>
            </div>
        </div>
    </div>
    </footer>
</body>

</html>
