<?php
$allsqlusers = $connection->query(" select * from users ");



if(!empty($_POST["updateRolebtn"])){
    $id_user=$_POST["id_update_user"];
    $role=$_POST["roles"];
    $oldrole=$_POST["old_role"];
    $sql = $connection->query( "update users set role='$role' where users.id=$id_user");
    if ($sql){
        if ($oldrole == "Client"){
            $remove = $connection->query("delete from clients where id_user = $id_user");
        }elseif ($oldrole == "Seller"){
            $seller = $connection->query("delete from sellers where id_user = $id_user");
        }elseif ($oldrole == "Developer"){
            $developer = $connection->query("delete from developers where id_user = $id_user");
        }
        if ($role == "Client"){
            $add = $connection->query("insert into clients (`id`, `id_user`) VALUES (NULL, '$id_user') ");
        }elseif ($role == "Seller"){
            $add = $connection->query("insert into sellers (`id`, `id_user`) VALUES (NULL, '$id_user') ");
        }elseif ($role == "Developer"){
            $add = $connection->query("insert into developers (`id`, `id_user`) VALUES (NULL, '$id_user') ");
        }

    }
    
}
if(!empty($_POST["updateAccountbtn"])){
    $id_user=$_POST["id_update_account"];
    $name=$_POST["name"];
    if ($name == ""){
        $name = ($connection->query("select * from users where id = '$id_user'")->fetch_object())->name;
    }
    $cellphone = $_POST["cellphone"];
    if ($cellphone == ""){
        $cellphone = ($connection->query("select * from users where id = '$id_user'")->fetch_object())->cellphone;

    }else{
        echo 'No se dectecto el celular'.($cellphone == "");
    }
    $password = $_POST["password"];
    if ($password == ""){
        $password = ($connection->query("select * from users where id = '$id_user'")->fetch_object())->password;
    }
    $sql = $connection->query( " update users set name='$name', cellphone = '$cellphone', password = '$password' where users.id=$id_user");
    if ($sql){
        $sql=$connection->query(" select * from users where id= '$id_user' ");
        // es el select de mysql con la base de datos
        if ($dates=$sql->fetch_object()){//si sql devuelve una lista de atributos
            $_SESSION["id"]=$dates->id;//almacenando el id del usuario
            $_SESSION["name"]=$dates->name;
            $_SESSION["email"]=$dates->email;
            $_SESSION["password"]=$dates->password;
            $_SESSION["role"]=$dates->role;
            $_SESSION["cellphone"]=$dates->cellphone;
            header("location: account.php");

        }
    }

    
    
}
if(!empty($_POST["deleteAccountBtn"])){
    $id_user=$_POST["id_update_account"];
}
?>
