<?php session_start();
include "header.php";
include "config.php";
// unset($_SESSION['cart']);
// unset($_SESSION['subtotal']);
if (isset($_GET['id'])) {
   
    $id = $_GET['id'];
    $action = $_GET['action'];
    
    switch ($action) {
        case 1:
            add_to_cart($id);
            break;
        case 2:
            
            remove_product($id);
            break;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Products</title>
    <link type="text/css" rel="stylesheet" href="style.css">
</head>

<body>
    <?php  ?>
    <div id="main">
        <div id="products">
            <?php product_listing() ?>
        </div>
    </div>
    <div id='cart'>
        <div id='product_list'>
            <table id='product-table'>
                <tr>
                    <th>Product</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Product Price</th>
                    <th>Remove Product</th>
                </tr>
                <?php echo update_cart(); ?>
            </table>
            <div id="subtotal">
                <p id='subtotal'>Your subtotal is $<?php echo get_subtotal(); ?></p>
            </div>
        </div>
    </div>
    <?php
    ?>
    <?php include "footer.php" ?>

</body>

</html>