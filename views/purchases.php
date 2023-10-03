<?php
include "../controllers/controller_session.php";
session_start();
checkSessionAndRedirect($requiredRole = "Seller");
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
      <?php
      include "../models/connection.php";
      include "../controllers/controller_products.php";
      include "../controllers/controller_purchases.php";
      while ($purchases = $allsqlpurchases->fetch_object()) {
        $products = getItemByID($purchases->id_product, "products");
        $id_user = getItemByID($purchases->id_client,"clients")->id_user;
        $payments = getItemByID($purchases->id_payment, "payments");
        $user = getItemByID($id_user, "users");
      ?>
        <div class="card_seller">
          <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia) ?>"></div>
          <text>
            <h2 class="tittle">Purchase#<?= $purchases->id ?> of Cliente #<?= $purchases->id_client ?> (User #<?= $id_user ?> Email: <?= $user->email ?> ): <?php echo $products->name; ?></h2>
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
        <!-- modal aprove---------------------------------------------------------->
        <div id="modal_aprove_purchase#<?= $purchases->id ?>" class="modal">

          <!-- Modal content aprove-------------------------------------- -->
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
              <input type="hidden" value="<?= $purchases->id_payment ?>" name="id_payment">
              <input type="hidden" value="<?= $purchases->id_payment ?>" name="id_payment"> <br><br>
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
              <input class="addi" type="hidden" value="<?= $purchases->id ?>" name="id_delete">
              <input class="addi" type="hidden" value="<?= $purchases->id_payment ?>" name="id_payment">
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
  <?= scripts() ?>
</body>

</html>