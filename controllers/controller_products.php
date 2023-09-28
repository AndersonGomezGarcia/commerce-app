<?php
include_once "functions_controllers.php";
$sqlproducts = $connection->query(" select * from products");//pide la lista de los productos
if(!empty($_POST["registerbtn"])){//agregar productos
    try{
        if (!empty(addslashes(file_get_contents($_FILES["file_add"]["tmp_name"])))){//verifica si selecciono algun archivo
            $image = addslashes(file_get_contents($_FILES["file_add"]["tmp_name"]));//si lo selecciono, entonces lo pone dentro de la variable image
        }else{
            $image = null;//si no metio  ningun archivo lo declara como nulo
        }
    }catch(Error $e){
        $image= "";//agarra el error de no meter archivo y lo pone nulo o vacio
    }
    if (!(empty($_POST["name_add"]) or empty($_POST["description_add"]) or empty($_POST["price_add"]))){//comprueba que no haya espacios vacios
        $name = $_POST["name_add"];
        $description = $_POST["description_add"];
        $price = $_POST["price_add"];
        $sql = $connection->query("INSERT INTO products (description, name, price, discount, multimedia) VALUES ('$description','$name','$price',NULL,'$image')");
        if($sql==true){
            echo '<div class="alert_a alert-success">Product create correctly (reload page "F5" )</div>';
        }
    }else{
        echo '<div class="alert_d alert-danger">Product cannot register</div>';
    }clearHistory();
}
if(!empty($_POST["updatebtn"])){//actualizar productos
    $id=$_POST["id_update"];
    echo "sirve hasta aca";
    try{
        if (!empty(addslashes(file_get_contents($_FILES["file_update"]["tmp_name"])))){//verifica si selecciono algun archivo
            $image = addslashes(file_get_contents($_FILES["file_update"]["tmp_name"]));//si lo selecciono, entonces lo pone dentro de la variable image
        }else{
            $image = null;//si no metio  ningun archivo lo declara como nulo
        }     
    }catch(Error $e){
        $image= "";//agarra el error de no meter archivo y lo pone nulo o vacio
    }
    $name = $_POST["name_update"];
    $description = $_POST["description_update"];
    $price = $_POST["price_update"];
    if (empty($_POST["name_update"]) or empty($_POST["description_update"]) or empty($_POST["price_update"])){
        echo '<div class="alert_d alert-danger">Product cannot update</div>';
    }else{
        if($image == "" or $image == null){//comprueba si se cargo imagen, en caso de que no, no se actualiza la imagen
            $sql = $connection->query(" update products set description='$description', name = '$name' , price = '$price', discount = NULL where products.id=$id");
        }else $sql = $connection->query(" update products set description='$description', name = '$name' , price = '$price', discount = NULL, multimedia = '$image' where products.id=$id");
        
        header('location:../views/products.php');
        echo '<div class="alert_a alert-success">Product create correctly (reload page "F5" )</div>';
    }clearHistory();
}
if(!empty($_POST["deletebtn"])){//eliminar productos
    $id=$_POST["id_delete"];
    $sql = $connection->query(" delete from products where products.id='$id' ");
    clearHistory();
}?>