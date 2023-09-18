<?php

if(!empty($_POST["add_purchase_btn"])){
    
    $id_product=$_POST["id_product"];
    $valuepaid=$_POST["value_product"];
    $payment = $connection->query("INSERT INTO payments (id, valuepaid, halfpayment, accreditationdate) VALUES (null, '$valuepaid', null, null)");
    $payment_id =mysqli_insert_id($connection);
    $id_user=$_POST["id_user"];
    $clients=$connection->query("select * from clients where id_user = '$id_user'");
    $id_client=$clients->fetch_array()[0];

    $date = getdate();
    $datep ="". $date['mday']."/". $date['mon']."/". $date['year']."//". $date['hours'].":".$date['minutes']."::".$date['seconds']."";

    $purchaseInsert = $connection->query(" insert into purchases(id, paymentdate,  status, finishdate, id_payment, id_developer, id_product, id_seller, id_client) VALUES (null, '$datep', 'Todo', null,'$payment_id', null,'$id_product', null, '$id_client')");
    if($purchaseInsert){
        echo '<div class="alert_a alert-success">Product create correctly (reload page "F5" )</div>';
    }else{
        echo '<div class="alert_d alert-success">Product cannot create correctly (reload page "F5" )</div>';
    }

}

?>