<?php
session_start();
if (empty($_SESSION["id"])) {
}
?>
<html lang="en">
<head>
  <?php include "../controllers/controller_html.php";
  head("Home"); 
  
  ?>
  
</head>
<body>
  <div id="blur">
    <header>
      <?php nav(); ?>
    </header>
    <div class="front-page">
      <div class="text">
        <h1>Digit Col</h1>
        <h2>We offer high-quality digital products and services, designed to meet the highest standards.</h2>
      </div>
    </div>
    <div class="front-two"></div>
    <div class="catalogue">
      <h1>Catalogue</h1>
      <h2>Recomendates articles</h2>
      <?php
      include "../models/connection.php";
      include "../controllers/controller_products.php";
      include "../controllers/controller_purchases.php";
      while ($products = $sqlproducts->fetch_object()) {
        if (!$products->status) continue;
        if (empty($_SESSION["id"])){// si no se ha logeado le da un id de sesion 0
          $id_session = 0;
        }else $id_session =  $_SESSION["id"];

      ?>
        <!-- Aca empieza el for each de la lista de products---------------------------------------------------------------->
        <div class="card">
          <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia) ?>"></div>
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
            <h3 class="subtitled_add access">Are you sure of buy this item?:</h3>
            <div class="card_seller alert">
              <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia) ?>"></div>
              <text>
                <h2 class="tittle"><?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
              </text>
              <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>
              </div>
            </div>
            <form class="form_add" action="" enctype="multipart/form-data" method="POST">
              <input type="hidden" value="<?= $products->id ?>" name="id_product">
              <input type="hidden" value="<?php echo $products->price; ?>" name="value_product">
              <input type="hidden" value="<?=$id_session ?>" name="id_user"> <br><bR>
              <label>
                <h2> Enter details about the type of service you want. </h2>
              </label><br> <br>
              <textarea type="text" value="" name="details"> </textarea>
              <br><br>
              <button class="cancelb" onclick="closeModal(<?= $products->id ?>)">Cancel</button>
              <button class="addb" name="add_purchase_btn" type="submit" value="ok">Buy</button>
            </form>
          </div>
        </div>
      <?php
      } //Aca termina el foreach de los elementos de sql -------------------------------------------------------------
      ?>
    </div>
    <footer>
      <p>Derechos Reservados &copy; DigitCol</p>
    </footer>
  </div>
  <script src="script.js"></script>
</body>
</html>