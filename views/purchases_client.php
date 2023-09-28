<?php

use function PHPSTORM_META\type;

session_start();
if(empty($_SESSION["id"])){
  //$active = false;
    //header("location: login.php");
    header("location: login.php");
    if (!$_SESSION["role"] == "Seller"){
      header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=”Expires” content=”0″>
<meta http-equiv=”Last-Modified” content=”0″>
<meta http-equiv=”Cache-Control” content=”no-cache, mustrevalidate”>
    <meta http-equiv=”Pragma” content=”no-cache”>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="/css/Recurso.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->

</head>
<body>
    <input type="hidden" name="id_user">
    <div id="blur">
    <header>
     <?php include "../controllers/controller_nav.php"; nav(); ?>
    </header>
    <div class="products catalogue block ">
        <text class="tittlep">
            <h1>Info about your purchases</h1>
            <h2>Options to manage it</h2>
        </text>
        <!-- Trigger/Open The Modal -->


        <!--El boton usa javascript del script.js para su funcionalidad de pop up -->    
        <?php
        include "../models/connection.php";
        include "../controllers/controller_products.php";
        include "../controllers/controller_purchases.php";
        include "../controllers/controller_payments.php";

        //-----------------------------------------------------------------------------------------------------------------------------------
        //esto es como un foreach para extrear los datos de products
        //----------------------------------------------------------------------------------------------------------------------------------------------------------
        while($purchases=$sqlpurchases->fetch_object()){
            $product= $connection->query("select * from products where products.id = '$purchases->id_product'");
            //  $details = ;
            while($prod=$product->fetch_object()){
                $products = $prod;
            }
            

          ?>
        <div class="card_seller">
          <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
          <text>
              <h2 class="tittle">Purchase#<?= $purchases->id ?>:  <?php echo $products->name; ?></h2>
              <h3><?php echo $products->description; ?>.</h3>
              <br>
              <h3 class="process" ><b>Your details:  </b> <?= $purchases->clientdetails;?>  </h3>
          </text>
          <div class="ed">
            <h2 class="price">$<?php echo $products->price; ?></h2>
            <button class="dangerButton" onclick="openModal('delete','purchase',<?= $purchases->id ?>)">Cancel Purchase</button>
          </div>
        </div>
        
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_delete_purchase#<?= $purchases->id ?>" class="modal">

        <!-- Modal content delete-------------------------------------- -->
        <div class="modal-content">
          
          <span class="close" onclick="closeModal('delete','purchase',<?= $purchases->id ?>)">&times;</span>
          <h1 class="danger">Cancel a purchase:</h1>
          <h3 class="subtitled_add danger">Are you sure of cancel this item?:</h3>
          
          <div class="card_seller alert">
            <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
                <h2 class="tittle">Purchase#<?= $purchases->id ?>: <?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
                <h3 ><b>Your details:  </b> <?= $purchases->clientdetails;?>  </h3>
                <br>

            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>

            </div>
        </div>
        
          <form class="form_add" action="" method="POST" > 
            <input type="hidden" value="<?= $purchases->id ?>" name="id_delete" >  
            <input type="hidden" value="<?= $purchases->id_payment ?>" name="id_payment" >  
            <br><br>
            <button class="addb" onclick="closeModal(<?= $purchases->id ?>)">Cancel</button>
            <button class="cancelb" name="deletePurchasebtn" type="submit" value="ok" >Delete</button>
          </form>
            
        </div>
        </div>
        
        <?php
        }?>
        

    </div>
    <footer>
		<p>Derechos Reservados &copy; DigitCol</p>
    </footer>
    </div>
    <div id="login-container">
        <div class="login-content">
            <button id="close-btn"></button>
            <h2>Log in</h2>
            <p>Ingrese sus datos de usuario</p>
            <input type="text" id="username-input" placeholder="Usuario:">
            <br>
            <input type="password" id="password-input" placeholder="Contraseña:">
            <br>
            <button id="login-end-btn">Entrar</button>
        </div>
    </div>
    
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script s   rc="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>