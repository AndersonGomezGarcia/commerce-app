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
                <li><a class="menu-text" href="index.php">Catalogue</a></li>
                <?php
                  if(!empty($_SESSION["id"])){
                    if($_SESSION["role"] == "Client")
                    echo'
                    <li><a class="menu-text" href="purchases_client.php">Your products</a></li>
                    ';
                    if($_SESSION["role"] == "Seller" OR $_SESSION["role"] == "Admin"){
                      echo '
                      <li><a class="menu-text" href="products.php">Products</a></li>
                      <li><a class="menu-text" href="purchases.php">Purchases</a></li>
                      ';
                      if($_SESSION["role"] == "Admin"){
                        echo '
                      <li><a class="menu-text" href="users.php">Users</a></li>';
                      }
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


    <div class="card_seller card_account">
            <text class="user" >
                <h2 class="tittle bigsize"><div class="colorgreen" >id: #<?php echo $_SESSION["id"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Name:</div> <div class="colorblue"><?php echo $_SESSION["name"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Email: </div> <div class="colorblue"><?php echo $_SESSION["email"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Password: </div> <div class="colorblue"><?php echo $_SESSION["password"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Role:</div> <div class="colorblue"> <?php echo $_SESSION["role"]; ?> </div> </h2>
            </text>
            <div class="ed">
                <h2 class="price">Options</h2>
                <!--El boton usa javascript del script.js para su funcionalidad de pop up con el modificar -->
                <!--
                <button class="update_button"  onclick="openModal('update' , 'user' , <?= $_SESSION["id"] ?>)" >change information Role</button>-->
                <button class="delete_button" onclick="openModal('delete','user',<?= $_SESSION["id"]; ?>)">Delete</button>
            </div>
        </div>