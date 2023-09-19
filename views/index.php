<?php
session_start();
if(empty($_SESSION["id"])){
  //$active = false;
    
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="/css/Recurso.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    

</head>
<body>
    <div id="blur">
    <header>
        <nav class="menu">
            <ul>
                <li><a class="menu-text" href="">Inicio</a></li>
                <li><a class="menu-text" href="about.php">Acerca de</a></li>
                <li><a class="menu-text" href="">Catalogo</a></li>
                <?php
                  if(!empty($_SESSION["id"])){
                    if($_SESSION["role"] == "Client")
                    echo'
                    <li><a class="menu-text" href="purchases.php">Your products</a></li>
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
    <div class="front-page">
        <div class="text">
            <h1>Digit Col</h1>
            <h2>Ofrecemos servicios y productos digitales de alta calidad, diseñados para cumplir con los más altos estándares.</h2>
        </div>
    </div>
    <div class="front-two"></div>
    <div class="catalogue">
        <h1>Catalogo</h1>
        <h2>Articulos recomendados</h2>
        <?php
        include "../models/connection.php";
        include "../controllers/controller_products.php";
        include "../controllers/controller_purchases.php";
        
        
        while($products=$sqlproducts->fetch_object()){
          ?>
          <!-- Aca empieza el for each de la lista de products---------------------------------------------------------------->
        <div class="card">
            <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <h2 class="tittle"><?php echo $products->name; ?></h2>
            <h4><?php echo $products->description; ?>.</h3>
            <h2 class="price">$<?php echo $products->price; ?></h2>
            <button onclick="openModal('add','purchase',<?= $products->id ?>)">Purchase</button>
        </div>
        

        <!-- modal Solicitar---------------------------------------------------------->
        <div id="modal_add_purchase#<?= $products->id ?>" class="modal">

  <!-- Modal content Solicitar-------------------------------------- -->
        <div class="modal-content">
          
          <span class="close" onclick="closeModal('add','purchase','<?= $products->id ?>')">&times;</span>
          <h1 class="access">Buy a Product:</h1>
          <h3 class="subtitled_add access">Are you sure of buy  this item?:</h3>
          <div class="card_seller alert">
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
          <input type="hidden" value="<?= $products->id ?>" name="id_product">  
          <input type="hidden" value="<?php echo $products->price; ?>" name="value_product">  
          <input type="hidden" value="<?=$_SESSION["id"]?>" name="id_user" >  
            <br><br>
            <button class="cancelb" onclick="closeModal(<?= $products->id ?>)">Cancel</button>

            <button class="addb" name="add_purchase_btn" type="submit" value="ok">Buy</button>
          </form>
            
        </div>
        </div>
        
        
        
        
        
        <?php
        }//Aca termina el foreach de los elementos de sql -------------------------------------------------------------
        ?>
        
        

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
</body>
</html>