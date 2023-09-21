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

?>
