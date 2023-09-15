<?php
//conexion a la base de datos del comercio

//
$connection= new mysqli("localhost","root", "", "commerce_db");
$connection->set_charset("utf8");//para admitir una gama apmlia de caracterres
 
?>