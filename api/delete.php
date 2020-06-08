<?php
include_once("auth.php");
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $product = new Product($db);
    $product->id = $_GET["id"];

    if ($product->delete()) {
        header("Location: read.php");
    } else {
        printf("ERROR, CAN'T DELETE");
        header("Location: read.php");
    }
}
?>