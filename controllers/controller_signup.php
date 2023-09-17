<?php
if(!empty($_POST["signup"])){//el nombre del boton que hace click para submit post
    if (empty($_POST["name"]) or empty($_POST["email"]) or empty($_POST["password"]) or empty($_POST["confirmpassword"])){//verifica que no haya campos vacios en el register
        echo "<div class='alert alert-danger'>One of the space is empty, please complete the information</div>";
    }else{
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $role = "Client";

        $sql=$connection->query("insert into users(name, email, password, role)values('$name','$email','$password','$role')");//hace la consulta sql
        if ($sql==1){//verifica si sql retorna algun valor
            echo '<div class="alert alert-success">User create correctly</div>';
        }else{
            echo '<div class="alert alert-danger">User cannot register</div>';
        }
    }
}
?>