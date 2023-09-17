<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <section id="acerca">
        <h2>Acerca de DigitCol</h2>
        <p>Somos Digit Col, una empresa de marketing digital y posicionamiento web. En Digit Col, nuestro objetivo es ayudar a nuestros clientes a alcanzar sus objetivos de negocio y mejorar su presencia en línea. En Digit Col, creemos en el poder del marketing digital y la importancia de una presencia en línea sólida y efectiva. Nos apasiona lo que hacemos y nos enorgullece ayudar a nuestros clientes a alcanzar sus metas de negocio.</p>
        <p>Ofrecemos una amplia variedad de servicios, que incluyen la creación y administración de campañas publicitarias en redes sociales, el diseño y desarrollo de sitios web, la gestión de correo electrónico y la creación de contenido de calidad para mejorar el SEO.</p>
        <p>Nuestro equipo está formado por profesionales experimentados en marketing digital, diseño gráfico, desarrollo web y estrategia de negocios. Trabajamos de manera personalizada con cada cliente para entender sus objetivos y crear una estrategia de marketing única que se ajuste a sus necesidades.</p>
        <p>Nos enorgullece ofrecer soluciones eficaces y rentables para nuestros clientes, y siempre estamos en busca de nuevas formas de innovar y mejorar nuestras estrategias de marketing. Si necesitas mejorar tu presencia en línea y aumentar tu alcance, ¡DigitCol es la solución que buscas!</p>
    </section>

    <section id="servicios">
        <h2>Servicios de DigitCol</h2>
        <ul>
            <li>Creación y administración de campañas publicitarias en redes sociales</li>
            <li>Diseño y desarrollo de sitios web</li>
            <li>Gestión de correo electrónico</li>
            <li>Creación de contenido de calidad para mejorar el SEO</li>
        </ul>
    </section>

    <section id="equipo">
        <h2>Equipo de DigitCol</h2>
        <ul>
            <li>John Smith - CEO</li>
            <li>Jane Doe - Diseñadora Gráfica</li>
            <li>Mark Johnson - Desarrollador Web</li>
            <li>Sara Lee - Especialista en Marketing Digital</li>
        </ul>
    </section>

    <section id="contacto">
        <h2>Contacto de DigitCol</h2>
        <p>Puedes contactarnos a través de los siguientes medios:</p>
        <ul>
            <li>Teléfono: 555-1234</li>
            <li>Correo electrónico: info@DigitCol.com</li>
            <li>Dirección: 123 Main St, Ciudad, Estado, Código Postal</li>
        </ul>
    </section>
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