<?php
function nav(){
    ?>
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
                      <li><a class="menu-text" href="development_tasks.php">tasks</a></li>
                     <?php }
                    }elseif($_SESSION["role"] == "Developer"){?>
                      <li><a class="menu-text" href="developer_tasks.php">tasks</a></li>
                      <?php }
                    echo'
                    <a class="logout text-danger" href="../controllers/controller_signoff.php">LogOut</a>';
                  }
                ?>
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
        <?php
}
function head($tittle){
  ?><meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $tittle ?></title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/x-icon" href="/css/Recurso.png">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <?php
}
?>