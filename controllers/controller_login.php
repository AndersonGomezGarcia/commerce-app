<?php
session_start();//indica que inicia una sesion 

if(!empty($_POST{"btnlogin"})){//verifica que el boton de logi nse presiona
    //echo "btn presionado";
    if (!empty($_POST["email"] and !empty($_POST["password"]))){// verifica si tiene datos en email y password(views/login.php)
        $email = $_POST["email"];
        $password = $_POST["password"];//almacena la password

        $sql=$connection->query(" select * from users where email= '$email' and password='$password' ");
        // es el select de mysql con la base de datos
        if ($dates=$sql->fetch_object()){//si sql devuelve una lista de atributos
            $_SESSION["id"]=$dates->id;//almacenando el id del usuario
            $_SESSION["name"]=$dates->name;
            $_SESSION["email"]=$dates->email;
            $_SESSION["password"]=$dates->password;
            $_SESSION["role"]=$dates->role;
            header("location: index.php");
        }else{
            echo "<div class='alert alert-danger'>Accedo denegado</div>";
        }

    }else{
        echo "Por favor completa los datos";
    }
}
?>