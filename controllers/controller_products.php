<?php

$sqlproducts = $connection->query(" select * from products");//pide la lista de los productos


if(!empty($_POST["registerbtn"])){
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
            echo '<script>(function (){
                var not=function(){
                    window.history.replaceState(null, null, window.location.pathname);
                }
                setTimeout(not, 0)
            }())*/</script>';
            echo '<div class="alert_a alert-success">Product create correctly (reload page "F5" )</div>';
        }
    }else{
        echo '<div class="alert_d alert-danger">Product cannot register</div>';
    }
}
//-------------------------------------------------------------------------------------------------------
//todo lo de la funcionalidad de update products
//--------------------------------------------------------------------------------------------------------

if(!empty($_POST["updatebtn"])){
    $id=$_POST["id_update"];
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
        $sql = $connection->query(" update products set description='$description', name = '$name' , price = '$price', discount = NULL, multimedia = '$image' where products.id=$id");
        echo '<div class="alert_a alert-success">Product create correctly (reload page "F5" )</div>';

    }
    
    ?>
    <script>
        
        (function (){
            var not=function(){
                window.history.replaceState(null, null, window.location.pathname);
            }
            setTimeout(not, 0)
        }())
    </script>
    <?php
    }
    
//-------------------------------------------------------------------------------------------------------
//termina lo de update
//-------------------------------------------------------------------------------------------------------
//empieza lo de delete- -----------------------------------------------------------------------

if(!empty($_POST["deletebtn"])){
    $id=$_POST["id_delete"];
    $sql = $connection->query(" delete from products where products.id='$id' ");




}


//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
?>