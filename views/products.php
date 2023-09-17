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
        <button class="addp">Add product</button>

        <div class="card_seller">
            <div class="image"></div>
            <text>
                <h2 class="tittle">Hotel</h2>
                <h3>Nuestro plan de marketing para hoteles, respaldado por nuestra amplia experiencia en el sector, ofrece una solución integral para mejorar su posición en el mercado y atraer más huéspedes. Con un costo asequible, le brindamos la oportunidad de destacar en un mercado competitivo y maximizar su rentabilidad.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$150.000</h2>
                <button>Editar</button>
                <button>Eliminar</button>
            </div>
        </div>
        <div class="card_seller">
            <div class="image"></div>
            <text>
                <h2 class="tittle">Hotel</h2>
                <h3>Nuestro plan de marketing para hoteles, respaldado por nuestra amplia experiencia en el sector, ofrece una solución integral para mejorar su posición en el mercado y atraer más huéspedes. Con un costo asequible, le brindamos la oportunidad de destacar en un mercado competitivo y maximizar su rentabilidad.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$150.000</h2>
                <button>Editar</button>
                <button>Eliminar</button>
            </div>
        </div>
        <div class="card_seller">
            <div class="image"></div>
            <text>
                <h2 class="tittle">Hotel</h2>
                <h3>Nuestro plan de marketing para hoteles, respaldado por nuestra amplia experiencia en el sector, ofrece una solución integral para mejorar su posición en el mercado y atraer más huéspedes. Con un costo asequible, le brindamos la oportunidad de destacar en un mercado competitivo y maximizar su rentabilidad.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$150.000</h2>
                <button>Editar</button>
                <button>Eliminar</button>
            </div>
        </div>
        <div class="card_seller">
            <div class="image"></div>
            <text>
                <h2 class="tittle">Hotel</h2>
                <h3>Nuestro plan de marketing para hoteles, respaldado por nuestra amplia experiencia en el sector, ofrece una solución integral para mejorar su posición en el mercado y atraer más huéspedes. Con un costo asequible, le brindamos la oportunidad de destacar en un mercado competitivo y maximizar su rentabilidad.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$150.000</h2>
                <button>Editar</button>
                <button>Eliminar</button>
            </div>
        </div>
        

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