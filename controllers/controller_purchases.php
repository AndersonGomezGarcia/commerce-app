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
    if($_SESSION["role"] != "Client"){
        echo '<div class="alert_a alert-success">You dont be a client</div>';
    }
    else{
    
    $id_product=$_POST["id_product"];
    $valuepaid=$_POST["value_product"];
    $payment = $connection->query("INSERT INTO payments (id, valuepaid, method_payment, accreditationdate) VALUES (null, '$valuepaid', null, null)");
    $payment_id =mysqli_insert_id($connection);
    $details=$_POST["details"];

    $date = getdate();
    $datep ="". $date['mday']."/". $date['mon']."/". $date['year']."//". $date['hours'].":".$date['minutes']."::".$date['seconds']."";

    $purchaseInsert = $connection->query(" insert into purchases(id, paymentdate,  status, finishdate, clientdetails, id_payment, id_developer, id_product, id_seller, id_client) VALUES (null, '$datep', 'Todo', null,'$details','$payment_id', null,'$id_product', null, '$id_client')");
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
}
if(!empty($_POST["deletePurchasebtn"])){
    $id=$_POST["id_delete"];
    $id_payment=$_POST["id_payment"];
    $sql = $connection->query(" delete from purchases where purchases.id='$id' ");
    if($sql){
        $sql = $connection->query(" delete from payments where payments.id='$id_payment' ");
    }else{
    }
    echo '<div class="alert_d alert-success">Purchase deleted correctly (Your products)</div>';
    clearHistory();
    


}
if(!empty($_POST["updateStatusPurchasebtn"])){
    $idPurchase = $_POST["id_update_purchase"];
    $status = $_POST["status"];
    $sql = $connection->query("update purchases set status = '$status' where id = '$idPurchase' ");
    if ($sql){
        echo '<div class="alert_s success">Purchase deleted correctly (Your products)</div>';
    }else{
        echo '<div class="alert_s success">Cannot purchase (Your products)</div>';
    }

}
function todayDate(){
    $date = getdate();
    $datep ="". $date['mday']."/". $date['mon']."/". $date['year']."//". $date['hours'].":".$date['minutes']."::".$date['seconds']."";
    return $datep;
}

//Options for developersDevelopers
if(!empty($_POST["updateStatusDeveloperPurchasebtn"])){
    
    $idPurchase = $_POST["id_update_purchase"];
    $status = $_POST["status"];
    $idDeveloper = $_POST["id_developer"];
    $sql = $connection->query("update purchases set status = '$status' where id = '$idPurchase' ");
    $todayDate = todayDate();
    if ($sql){
        $sql = $connection->query("update purchases set id_developer = '$idDeveloper' where id = '$idPurchase' ");
        echo '<div class="accessb access">Purchase status update correctly</div>';
        if ($status == "Done"){
            $sql = $connection->query("update purchases set finishdate = '$todayDate' where id = '$idPurchase' ");
        }
    }
    echo '<h1>aaa</h1>';
   
}   

function getProduct () {
    $product= $GLOBALS["connection"]->query("select * from products where products.id = '$purchases->id_product'");
}

function clearHistory(){
    ?>

    <?php
}
?>

