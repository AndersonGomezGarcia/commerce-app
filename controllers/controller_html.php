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
                      <li><a class="menu-text" href="backups.php">Backups</a></li>
                      <li><a class="menu-text" href="Reports.php">Reports</a></li>
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
                <img src = "css/user.svg" class="user_svg"/>
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

function scripts(){
  ?><script src="script.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script s rc="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> <?php
}
?>