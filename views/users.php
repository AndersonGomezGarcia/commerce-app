<?php
session_start();
if (empty($_SESSION["id"])) {
  //$active = false;
  //header("location: login.php");
  header("location: login.php");
  if (!$_SESSION["role"] == "Admin") {
    header("location: index.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../controllers/controller_html.php";
  head("Users"); ?>
</head>

<body>
  <div id="blur">
    <header>
      <?= nav(); ?>
    </header>
    <div class="products catalogue block ">
      <text class="tittlep">
        <h1>Users registered</h1>
        <h2>Options to edit them.</h2>
      </text>
      <!-- The Modal add -->
      <div id="modal_add_product" class="modal">
        <!-- Modal content add -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <h1>Add a Product:</h1>
          <h3 class="subtitled_add">Complete the information:</h3>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST">
            <input type="text" name="name_add" placeholder="Title:"><br><br>
            <textarea name="description_add" id="" cols="30" rows="10" placeholder="Description:"></textarea> <br><br>
            <input type="number" name="price_add" placeholder="Price:"><br><br>
            <label class="a">Image Upload:</label><input type="file" class="file_add" name="file_add"><br><br>
            <button class="cancelb">Cancel</button>
            <button class="addb" name="registerbtn" type="submit" value="ok">Add</button><!--El boton usa javascript del script.js para su funcionalidad de pop up -->
          </form>
        </div>
      </div>
      <?php
      include "../models/connection.php";
      include "../controllers/controller_products.php";
      include "../controllers/controller_users.php";
      while ($users = $allsqlusers->fetch_object()) {//recorre los usuarios
      ?>
        <div class="card_seller">
          <text class="user">
            <h2 class="tittle bigsize">
              <div class="colorgreen">id: #<?php echo $users->id; ?></div>
            </h2>
            <h2 class="subtittle">
              <div class="colorfuxy">Name:</div>
              <div class="colorblue"><?php echo $users->name; ?></div>
            </h2>
            <h2 class="subtittle">
              <div class="colorfuxy">Email: </div>
              <div class="colorblue"><?php echo $users->email; ?></div>
            </h2>
            <h2 class="subtittle">
              <div class="colorfuxy">Role:</div>
              <div class="colorblue"> <?php echo $users->role; ?> </div>
            </h2>
          </text>
          <div class="ed">
            <h2 class="price">Options</h2>
            <!--El boton usa javascript del script.js para su funcionalidad de pop up con el modificar -->
            <button class="accessButton" onclick="openModal('update' , 'user' , <?= $users->id ?>)">Update Role</button>
            <button class="dangerButton" onclick="openModal('delete','user',<?= $users->id ?>)">Delete</button>
          </div>
        </div>
        <!-- The Modal update para users--------------------->
        <div id="modal_update_user#<?= $users->id ?>" class="modal">
          <!-- Modal content update ----------------------->
          <div class="modal-content">
            <span class="close" onclick="closeModal( 'update','user',<?= $users->id ?>)">&times;</span>
            <h1>Update a the role of User#<?= $users->id ?></h1>
            <h3 class="subtitled_add">Choose a role:</h3>
            <div class="card_seller">
              <text class="user">
                <h2 class="tittle bigsize">
                  <div class="colorgreen">id: #<?php echo $users->id; ?></div>
                </h2>
                <h2 class="subtittle">
                  <div class="colorfuxy">Name:</div>
                  <div class="colorblue"><?php echo $users->name; ?></div>
                </h2>
                <h2 class="subtittle">
                  <div class="colorfuxy">Email: </div>
                  <div class="colorblue"><?php echo $users->email; ?></div>
                </h2>
                <h2 class="subtittle">
                  <div class="colorfuxy">Role:</div>
                  <div class="colorblue"> <?php echo $users->role; ?> </div>
                </h2>
              </text>
              <div class="ed">
                <h2 class="price"></h2>
              </div>
            </div>
            <form class="form_add" action="" enctype="multipart/form-data" method="POST">
              <input type="hidden" value="<?= $users->id ?>" name="id_update_user">
              <input type="hidden" value="<?= $users->role ?>" name="old_role">
              <labe class="fz">Rol:</label>
                <input type="hidden" select="roles" name="roles" id="browser"><!-- list= hace referencia al la datalist que usara como datos-->
                <select id="roles" name="roles">
                  <option name="Client" value="Client">Client</option>
                  <option name="Seller" value="Seller">Seller</option>
                  <option name="Developer" value="Developer">Developer</option>
                </select><br><br>
                <button class="cancelb" onclick="closeModal('update','user',<?= $users->id ?>)">Cancel</button>
                <button class="addb" name="updateRolebtn" type="submit" value="ok">Update role</button>
            </form>
          </div>
        </div>
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_delete_user#<?= $users->id ?>" class="modal">
          <!-- Modal content delete-------------------------------------- -->
          <div class="modal-content">
            <span class="close" onclick="closeModal('delete','user',<?= $users->id ?>)">&times;</span>
            <h1 class="danger">Delete a Product:</h1>
            <h3 class="subtitled_add danger">Are you sure of delete this item?:</h3>
            <div class="card_seller">
              <text class="user">
                <h2 class="tittle bigsize">
                  <div class="colorgreen">id: #<?php echo $users->id; ?></div>
                </h2>
                <h2 class="subtittle">
                  <div class="colorfuxy">Name:</div>
                  <div class="colorblue"><?php echo $users->name; ?></div>
                </h2>
                <h2 class="subtittle">
                  <div class="colorfuxy">Email: </div>
                  <div class="colorblue"><?php echo $users->email; ?></div>
                </h2>
                <h2 class="subtittle">
                  <div class="colorfuxy">Role:</div>
                  <div class="colorblue"> <?php echo $users->role; ?> </div>
                </h2>
              </text>
              <div class="ed">
                <h2 class="price"></h2>
              </div>
            </div>
            <form class="form_add" action="" enctype="multipart/form-data" method="POST">
              <input type="hidden" value="<?= $users->id ?>" name="id_user_delete" placeholder="Title:">
              <br><br>
              <button class="addb" onclick="closeModal('delete','user',<?= $users->id ?>)">Cancel</button>
              <button class="cancelb" name="deletebtn" type="submit" value="ok">Delete</button>
            </form>
          </div>
        </div>
      <?php continue;
      } ?>
    </div>
    <footer>
      <p>Derechos Reservados &copy; DigitCol</p>
    </footer>
  </div>
  <script src="script.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script s rc="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>