<?php
session_start();
?>
<html lang="en">
<head>
<?php  include "../controllers/controller_html.php"; head("Account"); ?>
</head>
<body>
    <div id="blur">
    <header>
      <?= nav(); ?>
    </header>
    <?php
include "../models/connection.php";
include "../controllers/controller_users.php";
?>
    <div class="card_seller card_account">
            <text class="user" >
                <h2 class="tittle bigsize"><div class="colorgreen" >id: #<?php echo $_SESSION["id"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Name:</div> <div class="colorblue"><?php echo $_SESSION["name"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Email: </div> <div class="colorblue"><?php echo $_SESSION["email"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Password: </div> <div class="colorblue"><?php echo $_SESSION["password"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Role:</div> <div class="colorblue"> <?php echo $_SESSION["role"]; ?> </div> </h2>
                <h2 class="subtittle"><div class="colorfuxy" >Number Tel:</div> <div class="colorblue"> <?php echo $_SESSION["cellphone"]; ?> </div> </h2>
              
            </text>
            <div class="ed">
                <h2 class="price">Options</h2>

                <button class="accessButton" onclick="openModal('update','account',<?= $_SESSION["id"] ?>)">Update</button>
                <!--<button class="dangerButton" onclick="openModal('delete','account',<?= $_SESSION["id"] ?>)">Delete</button>-->
                
            </div>
        </div>
        <!-- The Modal update my account--------------------->
      
        <div id="modal_update_account#<?=  $_SESSION["id"] ?>" class="modal">

  <!-- Modal content update ----------------------->
          <div class="modal-content m_auto">
          <center>
          
          <span class="close" onclick="closeModal( 'update','account',<?= $_SESSION["id"]  ?>)">&times;</span>
          <h1>Update you User#<?= $_SESSION["id"] ?></h1>
          <h3 class="subtitled_add">Choose a updates:</h3>
          <div class="card_seller m_auto">
            <text class="user" >
                <h2 class="tittle bigsize"><div class="colorgreen" >id: #<?php echo $_SESSION["id"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Name:</div> <div class="colorblue"><?php echo $_SESSION["name"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Email: </div> <div class="colorblue"><?php echo $_SESSION["email"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Password: </div> <div class="colorblue"><?php echo $_SESSION["password"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Role:</div> <div class="colorblue"> <?php echo $_SESSION["role"]; ?> </div> </h2>
                <h2 class="subtittle"><div class="colorfuxy" >Number Tel:</div> <div class="colorblue"> <?php echo $_SESSION["cellphone"]; ?> </div> </h2>
              
            </text>
        </div>
       
          <form class="form_add" action="" method="POST" >  
            <br><br> 
            <input type="hidden" value="<?= $_SESSION["id"] ?>" name="id_update_account" >
            <input type="text" value="" name="name" placeholder="New Name" ><br><br>
            <input type="number" value="" name="cellphone" placeholder="New number of cellphone" ><br><br>
            <input type="password" value="" id="password" name="password" placeholder="New password" ><br><br>
            <input type="password" value="" id="confirm_password"name="confirm_password" placeholder="Confirm new password" ><br><br>
            <button class="cancelb" onclick="closeModal('update','account',<?= $_SESSION["id"] ?>)">Cancel</button>
            <button class="addb" name="updateAccountbtn" type="submit" value="ok" >Update Info</button>
            </form>
          </center>
        </div>
        </div>
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_delete_account#<?=  $_SESSION["id"]?>" class="modal">

  <!-- Modal content delete-------------------------------------- -->
        <div class="modal-content">
          <center>
          
          <span class="close" onclick="closeModal('delete','account',<?= $_SESSION["id"] ?>)">&times;</span>
          <h1 class="danger">Delete a Product:</h1>
          <h3 class="subtitled_add danger">Are you sure of delete this item?:</h3>
          <div class="card_seller m_auto">
            <text class="user" >
                <h2 class="tittle bigsize"><div class="colorgreen" >id: #<?php echo $_SESSION["id"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Name:</div> <div class="colorblue"><?php echo $_SESSION["name"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Email: </div> <div class="colorblue"><?php echo $_SESSION["email"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Password: </div> <div class="colorblue"><?php echo $_SESSION["password"]; ?></div></h2>
                <h2 class="subtittle"><div class="colorfuxy" >Role:</div> <div class="colorblue"> <?php echo $_SESSION["role"]; ?> </div> </h2>
                <h2 class="subtittle"><div class="colorfuxy" >Number Tel:</div> <div class="colorblue"> <?php echo $_SESSION["cellphone"]; ?> </div> </h2>
              
            </text>

        </div>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST" > 
          <input type="hidden" value="<?= $_SESSION["id"] ?>" name="id_delete_account">
            <br><br> <label for=""><h2>Are your sure that delete your Account? </h2> </label>
            <button class="addb" onclick="closeModal('delete','account',<?php echo $_SESSION["id"]; ?>)">Cancel</button>
            <button class="cancelb" name="deleteAccountBtn" type="submit" value="ok" >Delete</button>
            </form>
            </center>
        </div>
        </div>
    </div>
    <script>var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;</script>
    <script src="script.js"></script>
  </body>
</html>