<?php session_start();
$_SESSION['cart'];
$_SESSION['subtotal'] = 0;
$products = array(
    array("id" => 101, "name" => "Basket Ball", "image" => "basketball.png", "price" => 150),
    array("id" => 102, "name" => "Football", "image" => "football.png", "price" => 120),
    array("id" => 103, "name" => "Soccer", "image" => "soccer.png", "price" => 110),
    array("id" => 104, "name" => "Table Tennis", "image" => "table-tennis.png", "price" => 130),
    array("id" => 105, "name" => "Tennis", "image" => "tennis.png", "price" => 100)
);

$subtotal = 0;

//product listing 
function product_listing()
{
    foreach ($GLOBALS['products'] as $product) {
        echo "<div id='" . $product[' id'] . "' class='product'>
                <img src='images/" . $product['image'] . "'>
                <h3 class='title'><a href='#'>" . $product['name'] . "</a></h3>
                <span>Price: $" . $product['price'] . "</span>
                <a class='add-to-cart' href='products.php?action=" . '1' . ' & id=' . $product['id'] . "'" . ">Add To Cart</a></div>";
    }
}
//add-to-cart
function add_to_cart($id)
{
    $bool = FALSE;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $val) {
            if ($val['id'] == $id) {
                $_SESSION['cart'][$key]['quantity'] += 1;
                $bool = TRUE;
            }
        }
        if (!$bool) {
            array_push($_SESSION['cart'], array('id' => $id, 'quantity' => 1));
            $bool = True;
        }
    } else {
        $_SESSION['cart'] = array();
        array_push($_SESSION['cart'], array('id' => $id, 'quantity' => 1));
    }
    //update_cart();
}
function update_cart()
{
    foreach ($_SESSION['cart'] as $key => $value) {
        $index = find_index($value['id']);
        $_SESSION['subtotal'] += $GLOBALS['products'][$index]['price'] * $_SESSION['cart'][$key]['quantity'];
        echo "<tr class='cart'>
        <td><img class='height' src='images/" . $GLOBALS['products'][$index]['image'] . "'></td>
        <td>" . $GLOBALS['products'][$index]['name'] . "</td>
        <td>" . $_SESSION['cart'][$key]['quantity'] . "</td>
        <td>" . $GLOBALS['products'][$index]['price'] * $_SESSION['cart'][$key]['quantity'] . "</td>
        <td ><a class='add-to-cart' href='products.php?action=" . '2' . ' & id=' . $value['id'] . "'" . ">X</a></td>
        </tr>";
    }
}
//find index in products
function find_index($id)
{
    for ($i = 0; $i < 5; $i++) {
        if ($GLOBALS['products'][$i]['id'] == $id) {
            return $i;
        }
    }
    return -1;
}
// remove product
function remove_product($id)
{
    foreach ($_SESSION['cart'] as $k => $v) {
        if ($v['id'] == $id) {
            unset($_SESSION['cart'][$k]);
        }
    }
}
function show_cart()
{
    echo "<hr>";
    echo count($_SESSION['cart']);
    foreach ($_SESSION['cart'] as $key => $val) {
        echo $_SESSION['cart'][$key]['id'] . '==' . $_SESSION['cart'][$key]['quantity'];
        echo "<br>";
    }
}

function get_subtotal()
{
    return $_SESSION['subtotal'];
}
    //header("Location:config.php");
