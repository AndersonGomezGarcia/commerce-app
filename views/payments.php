<?php
include "../controllers/controller_session.php";
session_start();
checkSessionAndRedirect($requiredRole = "Seller");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php  include "../controllers/controller_html.php"; head("Payments"); ?>
</head>
<body>
    <input type="hidden" name="id_user">
    <div id="blur">
    <header>
    <?= nav(); ?>
    </header>
    <div class="products catalogue block ">
        <text class="tittlep">
            <h1>Info about of all payments</h1>
            <h2>Options to manage it</h2>
        </text>
        <!--El boton usa javascript del script.js para su funcionalidad de pop up -->    
        <?php
        include "../models/connection.php";
        include "../controllers/controller_products.php";
        include "../controllers/controller_purchases.php";
        include "../controllers/controller_payments.php";
        //-----------------------------------------------------------------------------------------------------------------------------------
        //esto es como un foreach para extrear los datos de products
        //----------------------------------------------------------------------------------------------------------------------------------------------------------
        while($payments=$allsqlpayments->fetch_object()){       
            $purchase = ($connection->query("select * from purchases where id_payment = '$payments->id'"))->fetch_object();
            //echo '<h1>hola</h1>';
            $product = $connection->query("select * from products where id = '$purchase->id_product' ");
              while($prod=$product->fetch_object()){
                $products = $prod;
            }    
          ?>
          <div class="card_seller">
          <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
                <h2 class="tittle">Payment#<?= $payments->id ?> of purchase #<?= $purchase->id?>:  <?php echo $products->name ?> of client #<?= $purchase->id_client ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $payments->valuepaid; ?></h2>
                <!--El boton usa javascript del script.js para su funcionalidad de pop up con el modificar -->
                <?php 
            if($payments->method_payment == NULL){
              ?><button class="accessButton" onclick="openModal('approve','payments',<?= $payments->id ?>)">Approve</button><?php
            }else{?> 
              <h2><?= $payments->method_payment; ?></h2>
              <button class="cautionButton" onclick="openModal('disapprove','payments',<?= $payments->id ?>)">Disapprove</button> 
              <?php }?>
                <button class="dangerButton" onclick="openModal('delete','payments',<?= $payments->id ?>)">Delete</button>
            </div>
        </div>
         <!-- modal disapprove---------------------------------------------------------->
         <div id="modal_disapprove_payments#<?= $payments->id ?>" class="modal">
          <!-- Modal content delete-------------------------------------- -->
          <div class="modal-content">
            <span class="close" onclick="closeModal('disapprove','payments',<?= $payments->id ?>)">&times;</span>
            <h1 class="caution">Disapprove a Payment:</h1>
            <h3 class="subtitled_add caution">Are you sure of disapprove this payment?:</h3>
            <div class="card_seller alert">
          <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
              <h2 class="tittle">Payment#<?= $payments->id ?> of purchase #<?= $purchase->id?>:  <?php echo $products->name ?> of client #<?= $purchase->id_client ?></h2>
              <h3><?php echo $products->description; ?>.</h3>
            </text>
          <div class="ed">
              <h2 class="price">$<?php echo $products->price; ?></h2>
          </div>
      </div><br>
        <form class="form_add" action="" enctype="multipart/form-data" method="POST" > <br>
          <input type="hidden" value="<?= $payments->id ?>" name="id_aprove_payment">    
          <button class="cancelb" onclick="closeModal('disapprove','payments',<?= $payments->id ?>)">Cancel</button>
          <?php 
          if($payments->method_payment == NULL){
            ?><button class="addb" name="paymentApproveBtn" type="submit" value="ok" >Approve</button><?php  
             }else{?>
            <button class="addb crystalCautionButton" name="paymentDisapproveBtn" type="submit" value="ok" >Disapprove</button>
            <?php
          }
          ?>
          </form> 
      </div>
      </div>
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_approve_payments#<?= $payments->id ?>" class="modal">
  <!-- Modal content delete-------------------------------------- -->
        <div class="modal-content">         
          <span class="close" onclick="closeModal('approve','payments',<?= $payments->id ?>)">&times;</span>
          <h1 class="access">Aprove a Payment:</h1>
          <h3 class="subtitled_add access">Are you sure of aprove this payment?:</h3>
          <div class="card_seller alert">
        <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
            <h2 class="tittle">Payment#<?= $payments->id ?> of purchase #<?= $purchase->id?>:  <?php echo $products->name ?> of client #<?= $purchase->id_client ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>
            </div>
        </div><br>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST" > <br>
            <input type="hidden" value="<?= $payments->id ?>" name="id_aprove_payment">  
            <label>Method of payment</label>
            <input name="method_payment" class="" type="text" required>
            <br><br>
            <label>Payment Date</label>
            <input name="payment_date" class="date" type="date" required><br><br>
            <button class="cancelb" onclick="closeModal('approve','purchase',<?= $payments->id ?>)">Cancel</button>
            <?php 
            if($payments->method_payment == NULL){
              ?><button class="addb" name="paymentApproveBtn" type="submit" value="ok" >Approve</button><?php
               }else{?>
              <button class="addb" name="paymentDisapproveBtn" type="submit" value="ok" >Dispprove</button>
              <?php
            }
            ?>
            </form>
            
        </div>
        </div>
        
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_delete_payments#<?= $payments->id ?>" class="modal">

  <!-- Modal content delete-------------------------------------- -->
        <div class="modal-content">
          
          <span class="close" onclick="closeModal('delete','payments',<?= $payments->id ?>)">&times;</span>
          <h1 class="danger">Delete a Product:</h1>
          <h3 class="subtitled_add danger">Are you sure of delete this item?:</h3>
          <div class="card_seller alert">
        <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
                <h2 class="tittle">Purchase#<?= $purchase->id ?>: <?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>

            </div>
        </div>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST" > 
            <input class="addi" type="hidden" value="<?= $purchase->id ?>" name="id_delete" placeholder="Title:">  
            <input class="addi" type="hidden" value="<?= $purchase->id_payment ?>" name="id_payment" placeholder="Title:">  
            
            <br><br>
            <button class="addb" onclick="closeModal('delete','payments',<?= $payments->id ?>)">Cancel</button>
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
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script s   rc="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>