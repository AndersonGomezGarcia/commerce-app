<?php
include_once "functions_controllers.php";
$allsqlpayments = $connection->query(" select * from payments ");
if(!empty($_POST["paymentApproveBtn"])){//aprobar pago pendiente (agrega fecha y medio de pago)
    echo '<div class="alert_s success">Purchase deleted correctly (Your products)</div>';
    $idPayment = $_POST["id_aprove_payment"];
    $method = $_POST["method_payment"];
    $date = $_POST["payment_date"];
    $sql = $connection->query("update payments set method_payment = '$method', accreditationdate = '$date' where id = '$idPayment' ");
    if ($sql){
        echo '<div class="alert_s success">Purchase deleted correctly (Your products)</div>';
        echo $date;
        echo $method;
    }else{
        echo '<div class="alert_s success">Error in aprove</div>';
    }clearHistory();
}
if(!empty($_POST["paymentDisapproveBtn"])){//desaprobar pago que ya esta aprobado
    $idPayment = $_POST["id_aprove_payment"];
    $sql = $connection->query("update payments set method_payment = null, accreditationdate = null where id = '$idPayment' ");
    if ($sql){
        echo '<div class="alert_s success">Purchase deleted correctly (Your products)</div>';
    }else{
        echo '<div class="alert_s success">Error in aprove</div>';
    }clearHistory();
}
?> 