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
    <div id="blur">
    <header>
        <nav class="menu">
            <ul>
                <li><a class="menu-text" href="">Inicio</a></li>
                <li><a class="menu-text" href="about.php">Acerca de</a></li>
                <li><a class="menu-text" href="index.php">Catalogo</a></li>
                <?php
                  if(!empty($_SESSION["id"])){
                    if($_SESSION["role"] == "Client")
                    echo'
                    <li><a class="menu-text" href="">Your products</a></li>
                    ';
                    if($_SESSION["role"] == "Seller"){
                      echo '
                      <li><a class="menu-text" href="products.php">Products</a></li>
                      ';
                    }
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
              <button class="log-in center" id="login-btn" onclick="window.location.href="account.php";" >
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
            <h1>Catalogo informacion</h1>
            <h2>Opciones de edicion</h2>
        </text>
        <!-- Trigger/Open The Modal -->

<!-- The Modal -->
        <div id="modal_add_product" class="modal">

  <!-- Modal content -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <h1>Add a Product:</h1>
          <h3 class="subtitled_add">Complete the information:</h3>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST" >   
            <input class="addi" type="text" name="name_add" placeholder="Title:"><br><br>
            <textarea name="description_add" id="" cols="30" rows="10" placeholder="Description:"></textarea> <br><br>
            <input  type="number" name="price_add" placeholder="Price:" ><br><br>
            <label class="a" >Image Upload:</label><input type="file" class="file_add" name="file_add" ><br><br>
            <button class="cancelb">Cancel</button>
            <button class="addb" name="registerbtn" type="submit" value="ok" >Add</button>
            </form>
        </div>

        </div>
        <script>
          var conteo =0;
  
        </script>
        <!--El boton usa javascript del script.js para su funcionalidad de pop up -->
        <button id="btn_add_product" class="addp ">Add product</button>     
        <?php
        include "../models/connection.php";
        include "../controllers/controller_products.php";
  
        //esto es como un foreach para extrear los datos de products
        while($products=$sqlproducts->fetch_object()){
          ?>
        <div class="card_seller">
        <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
                <h2 class="tittle"><?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>
                <!--El boton usa javascript del script.js para su funcionalidad de pop up con el modificar -->
                <button class="update_button"  onclick="openModal('update' , 'product' , <?= $products->id ?>)" >Update</button>
                <button class="delete_button" onclick="openModalUpdate('delete','product' , <?= $products->id ?>)">Delete</button>
            </div>
        </div>
        <!-- The Modal -->
        <script>
          var conteo = conteo + 1;
          console.log(conteo)
        </script>
        <div id="modal_update_product#<?= $products->id ?>" class="modal">

  <!-- Modal content -->
        <div class="modal-content">
          
          <span class="close" onclick="closeModal(<?= $products->id ?>)">&times;</span>
          <h1>Update a Product:</h1>
          <h3 class="subtitled_add">Complete the information:</h3>
          <div class="card_seller">
        <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
                <h2 class="tittle"><?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>

            </div>
        </div>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST" >   
            <input class="addi" type="text" name="name_add" placeholder="Title:"><br><br>
            <textarea name="description_add" id="" cols="30" rows="10" placeholder="Description:"></textarea> <br><br>
            <input  type="number" name="price_add" placeholder="Price:" ><br><br>
            <label class="a" >Image Upload:</label><input type="file" class="file_add" name="file_add" ><br><br>
            <button class="cancelb" onclick="closeModal(<?= $products->id ?>)">Cancel</button>
            <button class="addb" name="registerbtn" type="submit" value="ok" >Update</button>
            </form>
            
        </div>
        </div>
        
        <?php
        }?>
        <!-- intento de cerrar mediante window.onclick-->
        <script>
          window.onclick = function(event) {
          for (var i=1; i<=conteo;i+=1){
            
              if (event.target == document.getElementById("modal_update_product#"+i)) {
                document.getElementById("modal_update_product#"+i).style.display = "none";
              }
            }
          }
        </script>
        

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