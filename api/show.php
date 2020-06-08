<?php
include_once("auth.php");
header('Access-Control-Allow-Origin: *');

include_once('../core/initialize.php');
?>

<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php
$product = new Product($db);
$product->id = isset($_GET['id']) ? $_GET['id'] : die();
if (!$product->exists()) {
    printf("ERROR, PRODUCT DOES NOT EXIST");
    die();
}
$product->read_single();

?>

    <p> Name: <?=$product->name?>, category: <?=$product->category?> , price: <?=$product->price?></p>

</body>

</html>

