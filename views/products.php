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
<?php  include "../controllers/controller_html.php"; head("Products"); ?>
</head>
<body>
    <div id="blur">
    <header>
    <?= nav(); ?>
    </header>
    <div class="products catalogue block ">
        <text class="tittlep">
            <h1>Catalogo informacion</h1>
            <h2>Opciones de edicion</h2>
        </text>
<!-- The Modal add -->
        <div id="modal_add_product" class="modal">
  <!-- Modal content add -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <h1>Add a Product:</h1>
          <h3 class="subtitled_add">Complete the information:</h3>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST" >   
            <input  type="text" name="name_add" placeholder="Title:"><br><br>
            <textarea name="description_add" id="" cols="30" rows="10" placeholder="Description:"></textarea> <br><br>
            <input  type="number" name="price_add" placeholder="Price:" ><br><br>
            <label class="a" >Image Upload:</label><input type="file" class="file_add" name="file_add" ><br><br>
            <button class="cancelb">Cancel</button>
            <button class="addb" name="registerbtn" type="submit" value="ok" >Add</button>
            </form>
        </div>

        </div>
        <script>
          var conteo =0;
  
        </script>
        <!--El boton usa javascript del script.js para su funcionalidad de pop up -->
        <button id="btn_add_product" class="addp ">Add product</button>     
        <?php
        include "../models/connection.php";
        include "../controllers/controller_products.php";
        //-----------------------------------------------------------------------------------------------------------------------------------
        //esto es como un foreach para extrear los datos de products
        //----------------------------------------------------------------------------------------------------------------------------------------------------------
        while($products=$sqlproducts->fetch_object()){
          ?>
        <div class="card_seller">
        <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
                <h2 class="tittle"><?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>
                <!--El boton usa javascript del script.js para su funcionalidad de pop up con el modificar -->
                <button class="accessButton"  onclick="openModal('update' , 'product' , <?= $products->id ?>)" >Update</button>
                <button class="dangerButton" onclick="openModal('delete','product',<?= $products->id ?>)">Delete</button>
            </div>
        </div>
        <!-- The Modal update para products--------------------->

         <!-- Modal content update ----------------------->
        <div id="modal_update_product#<?= $products->id ?>" class="modal">

 
        <div class="modal-content">
          
          <span class="close" onclick="closeModal( 'update','product',<?= $products->id ?>)">&times;</span>
          <h1>Update a Product:</h1>
          <h3 class="subtitled_add">Complete the information:</h3>
          <div class="card_seller">
        <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
                <h2 class="tittle"><?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>
            </div>
        </div>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST" >   
            <input type="hidden" value="<?= $products->id ?>" name="id_update" >
            <input type="text" name="name_update" placeholder="Title:"><br><br>
            <textarea name="description_update" id="" cols="30" rows="10" placeholder="Description:"></textarea> <br><br>
            <input  type="number" name="price_update" placeholder="Price:" ><br><br>
            <label class="a" >Image Upload:</label><input type="file" class="file_add" name="file_update" ><br><br>
            <button class="cancelb" onclick="closeModal('update','product',<?= $products->id ?>)">Cancel</button>
            <button class="addb" name="updatebtn" type="submit" value="ok" >Update</button>
            </form>    
        </div>
        </div>
        <!-- modal delete---------------------------------------------------------->
        <div id="modal_delete_product#<?= $products->id ?>" class="modal">
  <!-- Modal content delete-------------------------------------- -->
        <div class="modal-content">   
          <span class="close" onclick="closeModal('delete','product',<?= $products->id ?>)">&times;</span>
          <h1 class="danger">Delete a Product:</h1>
          <h3 class="subtitled_add danger">Are you sure of delete this item?:</h3>
          <div class="card_seller alert">
        <div class="image"><img src="data:image/jpg;base64,<?= base64_encode($products->multimedia)?>"></div>
            <text>
                <h2 class="tittle"><?php echo $products->name; ?></h2>
                <h3><?php echo $products->description; ?>.</h3>
            </text>
            <div class="ed">
                <h2 class="price">$<?php echo $products->price; ?></h2>
            </div>
        </div>
          <form class="form_add" action="" enctype="multipart/form-data" method="POST" > 
          <input type="hidden" value="<?= $products->id ?>" name="id_delete" >  
            <br><br>
            <button class="addb" onclick="closeModal(<?= $products->id ?>)">Cancel</button>
            <button class="cancelb" name="deletebtn" type="submit" value="ok" >Delete</button>
            </form>     
        </div>
        </div>   
        <?php
        }?>
   
    </div>
    <footer>
		<p>Derechos Reservados &copy; DigitCol</p>
    </footer>
    </div>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script s   rc="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>