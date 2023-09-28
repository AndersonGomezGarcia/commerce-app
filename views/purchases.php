<?php
session_start();
if (empty($_SESSION["id"])) {
  header("location: login.php");
  if (!$_SESSION["role"] == "Seller") {
    header("location: index.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../controllers/controller_html.php";
  head("Home"); ?>
</head>
<body>
  <input type="hidden" name="id_user">
  <div id="blur">
    <header>
      <?= nav(); ?>
    </header>
    <div class="products catalogue block ">
      <text class="tittlep">
        <h1>Info about of all purchases</h1>
        <h2>Options to manage it</h2>
      </text>
      <!--El boton usa javascript del script.js para su funcionalidad de pop up -->
      <?php
      include "../models/connection.php";
      include "../controllers/controller_products.php";
      include "../controllers/controller_purchases.php";
      //-----------------------------------------------------------------------------------------------------------------------------------
      //esto es como un foreach para extrear los datos de products
      //----------------------------------------------------------------------------------------------------------------------------------------------------------
      while ($purchases = $allsqlpurchases->fetch_object()) {
        $product = $connection->query("select * from products where products.id = '$purchases->id_product'");
        $payments = ($connection->query("select * from payments where id = '$purchases->id_payment'"))->fetch_object();

        while ($prod = $product->fetch_object()) {
          $products = $prod;
        }
      ?>
        <div class="card_seller">
          <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia) ?>"></div>
          <text>
            <h2 class="tittle">Purchase#<?= $purchases->id ?> of Cliente #<?= $purchases->id_client ?>: <?php echo $products->name; ?></h2>
            <h3><?php echo $products->description; ?>.</h3>
          </text>
          <div class="ed">
            <!--El boton usa javascript del script.js para su funcionalidad de pop up con el modificar -->
            <?php
            if ($payments->method_payment == NULL) {
            ?><div class="cancelb">Disapproved<br>Payment #<?= $purchases->id_payment ?></div><?php
                                                                                            } else { ?>
              <div class="addb">Approved<br>Payment #<?= $purchases->id_payment ?></div>
            <?php
                                                                                            }
            ?><h2 class="price">$<?php echo $products->price; ?></h2>
            <button class="dangerButton" onclick="openModal('delete','purchase',<?= $purchases->id ?>)">Delete</button>
          </div>
        </div>
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_aprove_purchase#<?= $purchases->id ?>" class="modal">

          <!-- Modal content delete-------------------------------------- -->
          <div class="modal-content">

            <span class="close" onclick="closeModal('aprove','purchase',<?= $purchases->id ?>)">&times;</span>
            <h1 class="danger">Delete a Product:</h1>
            <h3 class="subtitled_add danger">Are you sure of delete this item?:</h3>
            <div class="card_seller alert">
              <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia) ?>"></div>
              <text>
                <h2 class="tittle">Purchase#<?= $purchases->id ?>: <?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
              </text>
              <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>

              </div>
            </div>
            <form class="form_add" action="" enctype="multipart/form-data" method="POST">
              <input type="hidden" value="<?= $purchases->id ?>" name="id_delete">
              <input type="hidden" value="<?= $payments->id ?>" name="id_payment">
              <input class="addi" type="hidden" value="<?= $purchases->id_payment ?>" name="id_payment" placeholder="Title:">
              <input class="addi" type="hidden" value="<?= $purchases->id_payment ?>" name="id_payment" placeholder="Title:">
              <br><br>
              <button class="addb" onclick="closeModal(<?= $purchases->id ?>)">Cancel</button>
              <button class="cancelb" name="deletePurchasebtn" type="submit" value="ok">Aprove</button>
            </form>
          </div>
        </div>
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_delete_purchase#<?= $purchases->id ?>" class="modal">
          <!-- Modal content delete-------------------------------------- -->
          <div class="modal-content">
            <span class="close" onclick="closeModal('delete','purchase',<?= $purchases->id ?>)">&times;</span>
            <h1 class="danger">Delete a Product:</h1>
            <h3 class="subtitled_add danger">Are you sure of delete this item?:</h3>
            <div class="card_seller alert">
              <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia) ?>"></div>
              <text>
                <h2 class="tittle">Purchase#<?= $purchases->id ?>: <?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
              </text>
              <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>
              </div>
            </div>
            <form class="form_add" action="" enctype="multipart/form-data" method="POST">
              <input class="addi" type="hidden" value="<?= $purchases->id ?>" name="id_delete" placeholder="Title:">
              <input class="addi" type="hidden" value="<?= $purchases->id_payment ?>" name="id_payment" placeholder="Title:">
              <br><br>
              <button class="addb" onclick="closeModal(<?= $purchases->id ?>)">Cancel</button>
              <button class="cancelb" name="deletePurchasebtn" type="submit" value="ok">Delete</button>
            </form>
          </div>
        </div>
      <?php
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