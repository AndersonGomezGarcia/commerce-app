<?php
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
    <nav class="menu">
            <ul>
                <li><a class="menu-text" href="about.php">About</a></li>
                <li><a class="menu-text" href="index.php">Catalog</a></li>
                <?php
                  if(!empty($_SESSION["id"])){
                    if($_SESSION["role"] == "Client")
                    echo'
                    <li><a class="menu-text" href="purchases_client.php">Your products</a></li>
                    ';
                    if($_SESSION["role"] == "Seller" OR $_SESSION["role"] == "Admin"){?>
                      <li><a class="menu-text" href="products.php">Products</a></li>
                      <li><a class="menu-text" href="purchases.php">Purchases</a></li>
                      <li><a class="menu-text" href="payments.php">Payments</a></li>
                      <?php
                      if($_SESSION["role"] == "Admin"){?>
    
                      <li><a class="menu-text" href="users.php">Users</a></li>
                      <li><a class="menu-text" href="development_tasks.php">tasks</a></li>';
                     <?php }
                    }elseif($_SESSION["role"] == "Developer"){?>
                      echo'<li><a class="menu-text" href="developer_tasks.php">tasks</a></li>';
                      <?php }
                    echo'
                    <a class="logout text-danger" href="../controllers/controller_signoff.php">LogOut</a>';
                  }
                ?>
                
                <!--<li><a class="menu-text" href="client-atention.html">Atencion al cliente</a></li>-->
                <!--<li class="log-in"><a class="menu-text" href="">Log in/Register</a></li>-->
            </ul>
            <?php
            
            if (empty($_SESSION["id"])){
              echo'<button class="log-in" id="login-btn" onclick="window.location.href="login.php";" ><a href="login.php">Log in/  Register</a></button>';
            }else{
              
              
              echo'
              <button class="log-in center" id="login-btn" onclick="window.location.href="./account.php";" >
                <img src = "css/user.svg" class"user_svg"/>
                  <div class"block">
                    <h1 class"center block">'.$_SESSION["role"].'</h1>
                    <a class="block" href="account.php">'. $_SESSION["name"] .'  #'.$_SESSION["id"].'</a>
                  </div>
              </button>';
            }
            ?>
            
        </nav>
    </header>
    <div class="products catalogue block ">
        <text class="tittlep">
            <h1>Info about of all payments</h1>
            <h2>Options to manage it</h2>
        </text>
        <!-- Trigger/Open The Modal -->


        <!--El boton usa javascript del script.js para su funcionalidad de pop up -->    
        <?php
        include "../models/connection.php";
        include "../controllers/controller_products.php";
        include "../controllers/controller_purchases.php";
        include "../controllers/controller_payments.php";
        //include "../controllers/controller_users.php";

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
            if ($purchase->id_developer){
              $developer = $connection->query("select * from developers where id = '$purchase->id_developer'")->fetch_object();
              $developer_id = $developer->id;   
              $developer_name = ($connection->query("select * from users where id = '$developer->id_user'")->fetch_object())->name;
            }else{
              $developer_id = "?";
              $developer_name = "None";
            }


          ?>
          <div class="card_seller">
          <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
                <h2 class="tittle">Payment#<?= $payments->id ?> of purchase #<?= $purchase->id?>:  <?php echo $products->name ?> of client #<?= $purchase->id_client ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">-><?php 
                if( $purchase->status == "ToDo"){
                                 
                    echo "<text class='cancelb danger'>".$purchase->status."</text>";

                    echo "<br><br><br><text>".$developer_name." #".$developer_id."</text>";        
                } elseif($purchase->status == "InProgress"){
                    echo "<text class='addb access'>".$purchase->status."</text>"; 

                }elseif($purchase->status == "Done"){

                }
                    ?></h2>
                <!--El boton usa javascript del script.js para su funcionalidad de pop up con el modificar -->
                <button class="cautionButton" onclick="openModal('aprove','purchase',<?= $products->id ?>)">Change</button>
                <button class="dangerButton" onclick="openModal('delete','purchase',<?= $products->id ?>)">Report</button>
            </div>
        </div>
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_aprove_purchase#<?= $products->id ?>" class="modal">

  <!-- Modal content delete-------------------------------------- -->
        <div class="modal-content">
          
          <span class="close" onclick="closeModal('aprove','purchase',<?= $products->id ?>)">&times;</span>
          <h1 class="access">Update the state of a development:</h1>
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
            <input class="addi" type="hidden" value="<?= $purchase->id ?>" name="id_update_purchase" placeholder="Title:">  
            <label>New Status of the task:</label>
            
            <input type="hidden" select="status" name="roles" id="browser"><!-- list= hace referencia al la datalist que usara como datos-->
            <select id="roles" name="status" >
              <option value="ToDo">ToDo</option>
              <option value="InProgress">InProgress</option>
              <option value="Done">Done</option>
            </select><br><br>
            <button class="cancelb" onclick="closeModal('aprove','purchase',<?= $products->id ?>)">Cancel</button>
            <button class="addb" name="updateStatusPurchasebtn" type="submit" value="ok" >Update</button>
            </form>
            
        </div>
        </div>
        <!-- intento de cerrar mediante window.onclick-->
        <script>
          window.onclick = function(event) {
              if (event.target == document.getElementById("modal_aprove_purchase#<?= $products->id ?>")) {
                document.getElementById("modal_aprove_purchase#<?= $products->id ?>").style.display = "none";
              }
            }
        </script>
        
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_delete_purchase#<?= $products->id ?>" class="modal">

  <!-- Modal content delete-------------------------------------- -->
        <div class="modal-content">
          
          <span class="close" onclick="closeModal('delete','purchase',<?= $products->id ?>)">&times;</span>
          <h1 class="danger">Delete a Product:</h1>
          <h3 class="subtitled_add danger">Are you sure of delete this item?:</h3>
          <div class="card_seller alert">
        <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
                <h2 class="tittle">Purchase#<?= $purchases->id ?>: <?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>

            </div>
        </div>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST" > 
            <input class="addi" type="hidden" value="<?= $purchases->id ?>" name="id_delete" placeholder="Title:">  
            
            <br><br>
            <button class="addb" onclick="closeModal('delete','purchase',<?= $products->id ?>)">Cancel</button>
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