<?php
function  clearHistory(){
    ?>
<script>
(function (){var not=function(){window.history.replaceState(null, null, window.location.pathname);}
setTimeout(not, 0)}())</script>
    <?php
}
function todayDate(){
    $date = getdate();
    $datep ="". $date['mday']."/". $date['mon']."/". $date['year']."//". $date['hours'].":".$date['minutes']."::".$date['seconds']."";
    return $datep;
}

function getAllItems($item){
    return $GLOBALS["connection"]->query(" select * from $item");
}
function getItemByID($id, $item){
    return $GLOBALS["connection"]->query("select * from $item where id = '$id'")->fetch_object();
}
?>
