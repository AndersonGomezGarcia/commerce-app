<?php
include "../controllers/controller_session.php";
session_start();
checkSessionAndRedirect($requiredRole = "Developer");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php  include "../controllers/controller_html.php"; head("Tasks"); ?>
</head>
<body>
    <input type="hidden" name="id_user">
    <div id="blur">
    <header>
    <?= nav(); ?>
    </header>
    <div class="products catalogue block ">
        <text class="tittlep">
            <h1>Info about of all tasks</h1>
            <h2>Options to manage it</h2>
        </text>
        <?php
        include "../models/connection.php";
        include "../controllers/controller_products.php";
        include "../controllers/controller_purchases.php";
        include "../controllers/controller_payments.php";
        while($payments=$allsqlpayments->fetch_object()){//Recorre todos los pagos
          
            $purchase = ($connection->query("select * from purchases where id_payment = '$payments->id'"))->fetch_object();
            $product = $connection->query("select * from products where id = '$purchase->id_product' ");
              while($prod=$product->fetch_object()){
                $products = $prod;
            }
            if ($purchase->id_developer){// verifica si ya esta enlazado un desarrolador
              $developer = $connection->query("select * from developers where id = '$purchase->id_developer'")->fetch_object();
              $developer_id = $developer->id;   
              $developer_name = ($connection->query("select * from users where id = '$developer->id_user'")->fetch_object())->name;
              $developer_user = ($connection->query("select * from users where id = '$developer->id_user'")->fetch_object())->id;
            }else{
              $developer_id = "?";
              $developer_name = "None";
              $developer_user = "None";
            }
            if (!($developer_user == $_SESSION["id"] OR $developer_user == "None" ) OR  $payments->accreditationdate == NULL ){// esto verifica si tiene el nombre del desarrollador o no tiene ninguno asignado aun, y siempre y cuando ya ESTE FIJADO una fecha de inicio(cuando se apruebe el pago) 
                continue;
                
            } 
            $id_session = $_SESSION["id"];
            $id_developer = ($connection->query("select * from developers where id_user = '$id_session'")->fetch_object())->id;         
          ?>
          <div class="card_seller">
          <div class="image"> <b> Developer:</b> <br><text><?= $developer_name." #".$developer_id.""; ?></text></div>
            <text>
                <h2 class="tittle">Task#<?= $payments->id ?></h2>
                <h3>Payment#<?= $payments->id ?> of purchase #<?= $purchase->id?>:  Product#<?php echo $products->id ?>(<?php echo $products->name ?>) of client #<?= $purchase->id_client ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">-><?php 
                if( $purchase->status == "ToDo"){                    
                    echo "<text class='cancelb danger'>".$purchase->status."</text>";              
                } elseif($purchase->status == "InProgress"){
                    echo "<text class='processb caution'>".$purchase->status."</text>"; 
                }elseif($purchase->status == "Done"){
                  echo "<text class='addb access'>".$purchase->status."</text>";
                  echo "<br><br><h3>".$purchase->finishdate."</h3>" ;
                }    
                  ?></h2>
                <button class="cautionButton" onclick="openModal('aprove','purchase',<?= $payments->id ?>)">Change</button>
            </div>
        </div>
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_aprove_purchase#<?= $products->id ?>" class="modal">
  <!-- Modal content delete-------------------------------------- -->
        <div class="modal-content">
          <span class="close" onclick="closeModal('aprove','purchase',<?= $payments->id ?>)">&times;</span>
          <h1 class="access">Update the state of a development:</h1>
          <h3 class="subtitled_add access">Are you sure of aprove this payment?:</h3>
          <div class="card_seller alert">
        <div class="image"><br><br><br><text><?= $developer_name." #".$developer_id.""; ?></text></div>
            <text>
            <h2 class="tittle">Payment#<?= $payments->id ?> of purchase #<?= $purchase->id?>:  <?php echo $products->name ?> of client #<?= $purchase->id_client ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>
            </div>
        </div><br>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST" > <br>
            <input type="hidden" value="<?= $purchase->id ?>" name="id_update_purchase">  
            <input type="hidden" value="<?= $id_developer ?>" name="id_developer">  
            <h2><label>New Status of the task: <?= $id_developer ?> </label></h2>
            <input type="hidden" select="status" name="roles" id="browser"><!-- list= hace referencia al la datalist que usara como datos-->
            <select id="roles" name="status" >
              <option value="ToDo">ToDo</option>
              <option value="InProgress">InProgress</option>
              <option value="Done">Done</option>
            </select><br><br>
            <button class="cancelb" onclick="closeModal('aprove','purchase',<?= $payments->id ?>)">Cancel</button>
            <button class="addb" name="updateStatusDeveloperPurchasebtn" type="submit" value="ok" >Update</button>
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