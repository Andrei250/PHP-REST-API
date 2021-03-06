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

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
    $product->id = isset($_GET['id']) ? $_GET['id'] : die();

    if (!$product->exists()) {
        printf("ERROR, PRODUCT DOES NOT EXIST");
        die();
    }

    $product->read_single();
}
else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $q = 1;
    $product->id = $_POST['id'];
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $q = 0;
    } else {
        $product->name = $_POST["name"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$product->name)) {
            $nameErr = "Only letters and white space allowed";
            $q = 0;
        }
    }

    if (empty($_POST["category"])) {
        $categoryErr = "Category is required";
        $q = 0;
    } else {
        $product->category = $_POST["category"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$product->category)) {
            $categoryErr = "Only letters and white space allowed";
            $q = 0;
        }
    }

    if (empty($_POST["price"])) {
        $priceErr = "Price is required";
        $q = 0;
    } else {
        $product->price = $_POST["price"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[0-9]*.[0-9]*$/",$product->price)) {
            $priceErr = "This is not a number";
            $q = 0;
        }
    }

    $product->updated_date = date("Y-m-d");

    if ($q == 1) {
        if ($product->update()) {
            echo json_encode(
                array('message' => 'Product inserted')
            );
            header('Location: read.php');
        } else {
            echo json_encode(
                array('message' => 'Error')
            );
        }
    }


}

//print_r(json_encode($product_array));
?>

<h2>Update</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?=".$_GET['id'];?>">
    Name: <input type="text" name="name" value="<?php echo $product->name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    Category: <input type="text" name="category" value="<?php echo $product->category;?>">
    <span class="error">* <?php echo $categoryErr;?></span>
    <br><br>
    Price: <input type="text" name="price" value="<?php echo $product->price;?>">
    <span class="error">* <?php echo $priceErr;?></span>
    <br><br>
    <input type="hidden" name="id" value="<?php echo $product->id; ?>"/>
    <input type="submit" name="submit" value="Submit">
</form>

</body>

</html>

