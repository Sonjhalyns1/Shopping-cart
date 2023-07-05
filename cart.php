<?php
session_start();
require_once('php/CreateDb.php');
require_once('php/component.php');

// Create an instance of the CreateDb class
$database = new CreateDb("Productdatb", "Producttablb");

// Delete item from the cart
if (isset($_GET['remove'])) {
    if (isset($_SESSION['cart'])) {
        $product_id = $_GET['remove'];
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
            echo "<script>window.location = 'cart.php'</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <?php require_once("php/header.php"); ?>

    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart mt-3">
                    <h1>My Cart</h1>
                    <hr>

                    <?php
                    $total = 0;
                    $count = 0; // Variable to keep track of the item count

                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $product_id => $item) {
                            $result = $database->getData();

                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['id'] == $item['product_id']) {
                                    component(
                                        $row['product_name'],
                                        $row['product_price'],
                                        $row['product_image'],
                                        $row['product_original'],
                                        $row['product_description'],
                                        $row['id']
                                    );
                                    $total += (float)$row['product_price'];
                                    $count++; // Increment the item count
                                }
                            }
                        }
                    } else {
                        echo "<h5>Your cart is empty.</h5>";
                    }
                    ?>

                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if ($count > 0) {
                                echo "<h6>Price ($count items)</h6>";
                            } else {
                                echo "<h6>Price (0 items)</h6>";
                            }
                            ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Total Amount</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>$<?php echo number_format($total, 2); ?></h6>
                            <h6 class="text-success">FREE</h6>
                            <hr>
                            <h6>$<?php echo number_format($total, 2); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
