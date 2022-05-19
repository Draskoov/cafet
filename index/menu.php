<?php
require_once("database.php"); 
 session_start();  
 join_database();
 $edit = TRUE;
if(!isset($_COOKIE['login'])) {
    $edit = FALSE;
    }
    
if(!isset($_GET['id_user']))
{
    if($edit == TRUE)
	$_GET['id_user'] = $_COOKIE['login'];
    else
	$_GET['id_user'] = "";
}  
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Menu deja ajoute")</script>';  
                echo '<script>window.location="menu.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Menu supprimé")</script>';  
                     echo '<script>window.location="menu.php"</script>';  
                }  
           }  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Menu</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <link rel="stylesheet" href="menu_style.css">
      </head>  
      <body id="menu_style">
           <br />  
           <div class="container" style="width:1000px;">  
                <h3 style="font-weight: bold; text-align:center;">Menus de la semaine</h3><br />  
                <?php  
                $tab = select_fields("tbl_product"); 

                     foreach($tab as $row)  
                     {  
                ?>  
                <div class="col-md-4">  
                     <form method="post" action="menu.php?action=add&id=<?php echo $row["id"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:10px; align:center; margin-top:5%;">  
                               <img src="<?=$row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4 class="text-danger"> <?php echo $row["price"];?> €</h4>  
                               <input type="text" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Ajouter au panier" />  
                          </div>  
                     </form>  
                </div>  
                <?php  
                     } 
                     if($edit == TRUE)
                     { 
                ?>  
                <div style="clear:both"></div>  
                <br />  
                <h3 style="font-weight: bold; text-align: center;">Panier</h3>  
                <div style="background-color: white;"class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Menu</th>  
                               <th width="10%">Quantité</th>  
                               <th width="20%">Prix</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?> </td>  
                               <td> <?php echo $values["item_price"]; ?> €</td>  
                               <td> <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="menu.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Retirer l'article</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" style="align=right">Total</td>  
                               <td style="align=right"><?php echo number_format($total, 2); ?> €</td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
           <br />
           <div id="paypal-payment-button" style="text-align: center">
           <script src="https://www.paypal.com/sdk/js?client-id=AXPa0FVhZ4S1Ig7GTRiRJ3X2F6uiipsuDwrfhZ1NrfvP2A_y31nY2QfWgtnxcpOw96V0JPSmh92I2QDd"></script>
           <script>
           paypal.Buttons({
    style : {
        color: 'blue'
    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units:[{
              amount: {
                  value: '<?= $total ?>',
              }
            }]
        })
    },
    onApprove: function(data, actions) {
        // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
            console.log(details)
          window.location.replace("success.html")
        })
    }
}).render('#paypal-payment-button');
</script>
 </html>
 <?php }
 else echo "<h1> Connectez vous pour accéder au panier </h1>";