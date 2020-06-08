<?php
include_once("auth.php");
header('Access-Control-Allow-Origin: *');

include_once('../core/initialize.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Printing</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
<div>
    <h1>Welcome <?php echo $_SESSION['username']; ?>!</h1>
    <a href="logout.php">Logout</a>
</div>

<a href="create.php"><button class="btn btn-success">ADD NEW PRODUCT</button></a>
<?php
    $product = new Product($db);
    $result = $product->read();
    $num = $result->rowCount();

    if ($num > 0) {
        $product_array = array();
        $product_array['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $product_item = array(
                'id'    => $id,
                'name'  => $name,
                'category' => $category,
                'price' => $price,
                'created_date' => $created_date,
                'updated_date' =>$updated_date
            );

            array_push($product_array['data'], $product_item);
        }

        //echo json_encode($product_array);
        ?>
        <table class="table">
        <thead>
          <tr>
              <th>Number</th>
              <th>Name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>Controls</th>
          </tr>
        </thead>
        <tbody>
        <?php
        foreach ($product_array['data'] as $prod) {
            ?>
            <a>
                <td><?=$prod['id']?></td>
                <td><a href="show.php?id=<?=$prod['id']?>"><?=$prod['name']?></a></td>
                <td><?=$prod['category']?></td>
                <td><?=$prod['price']?></td>
                <td><?=$prod['created_date']?></td>
                <td><?=$prod['updated_date']?></td>
                <td><a href="delete.php?id=<?=$prod['id']?>"><button class="btn btn-danger">DELETE</button></a>
                    <a href="read_single.php?id=<?=$prod['id']?>"><button class="btn btn-primary">Update</button></td></a>
            </tr>
        <?php
        }

        ?>


        </tbody>
      </table>
        <?php

    } else {
        echo json_encode(array('message' => 'No products found!'));
    }

?>

</body>

</html>