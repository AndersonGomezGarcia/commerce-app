<?php
use function PHPSTORM_META\type;
include "../controllers/controller_session.php";
session_start();
checkSessionAndRedirect($requiredRole = "Client");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php  include "../controllers/controller_html.php"; head("Your purchases"); ?>
</head>
<body>
    <input type="hidden" name="id_user">
    <div id="blur">
    <header>
     <?= nav(); ?>
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
            $payments= ($connection->query("select * from payments where payments.id = '$purchases->id_payment'"))->fetch_object();
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
              <?php
            if ($payments->method_payment == NULL) {
            ?><div class="cancelb">Disapproved<br>Payment #<?= $purchases->id_payment ?></div><?php
                                                                                            } else { ?>
              <div class="addb">Approved<br>Payment #<?= $purchases->id_payment ?></div>
            <?php
                                                                                            }
            ?>
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
    <?= scripts() ?>
</body>
</html>