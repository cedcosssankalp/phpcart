<?php
session_start();
if (isset($_POST["submit"]) || isset($_POST["quantity"])) {
    $id = array_keys($_POST["submit"])[0];
    $val = $_POST["quantity"][$id];
    if (!$_SESSION["user"]["productsQuantity"][$id]) {
        header("location:products.php");
    } else {

        $_SESSION["user"]["productsQuantity"][$id] = $val;
        header("location:products.php");
    }
    header("location:products.php");
} else {
    header("location:products.php");
}