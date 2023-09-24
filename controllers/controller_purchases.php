<?php
if(!empty($_SESSION["id"])){
    if ($_SESSION["role"] == "Client"){
        $id_user=$_SESSION["id"];
        $clients=$connection->query("select * from  clients where id_user ='$id_user' ");
        $id_client=$clients->fetch_array()[0];
        $sqlpurchases = $connection->query(" select * from purchases where id_client = '$id_client'");
}}

$allsqlpurchases = $connection->query(" select * from purchases ");

if(!empty($_POST["add_purchase_btn"])){
    $id_product=$_POST["id_product"];
    $valuepaid=$_POST["value_product"];
    $payment = $connection->query("INSERT INTO payments (id, valuepaid, halfpayment, accreditationdate) VALUES (null, '$valuepaid', null, null)");
    $payment_id =mysqli_insert_id($connection);
    

    $date = getdate();
    $datep ="". $date['mday']."/". $date['mon']."/". $date['year']."//". $date['hours'].":".$date['minutes']."::".$date['seconds']."";

    $purchaseInsert = $connection->query(" insert into purchases(id, paymentdate,  status, finishdate, id_payment, id_developer, id_product, id_seller, id_client) VALUES (null, '$datep', 'Todo', null,'$payment_id', null,'$id_product', null, '$id_client')");
    if($purchaseInsert){
        /*echo '<script>(function (){
            var not=function(){
                window.history.replaceState(null, null, window.location.pathname);
            }
            setTimeout(not, 0)
        }())</script>';*/
        echo '<div class="alert_a alert-success">Purchase create correctly (Your products )</div>';
    }else{
        echo '<div class="alert_d alert-success">Product cannot create correctly</div>';
    }

}
if(!empty($_POST["deletePurchasebtn"])){
    $id=$_POST["id_delete"];
    $id=$_POST["id_payment"];
    $sql = $connection->query(" delete from purchases where purchases.id='$id' ");
    if($sql){
        $sql = $connection->query(" delete from payments where payments.id='$id_payment' ");
    }
    
    header("location: purchases_client.php");
    echo '<div class="alert_d alert-success">Purchase deleted correctly (Your products)</div>';




}
function getProduct () {
    $product= $GLOBALS["connection"]->query("select * from products where products.id = '$purchases->id_product'");
}
?>