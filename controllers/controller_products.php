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
            echo '<div class="alert_a alert-success">Product create correctly (reload page "F5" )</div>';
        }
    }else{
        echo '<div class="alert_d alert-danger">Product cannot register</div>';
    }
}
//

?>
<script>
    (function (){
        var not=function(){//se crea una variable not que contiene una funcion
            window.history.replaceState(null, null, window.location.pathname);//refresca la pagina
        }
        setTimeout(not, 0)//hace que se ejecute en el segundo 0
    }())//los parentesis hace que se ejecute automaticamente
</script>
<?php

?>