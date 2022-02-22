<?php
session_start();
if (isset($_GET["id"])) {
    unset($_SESSION["user"]["products"][$_GET["id"]]);
    unset($_SESSION["user"]["productsQuantity"][$_GET["id"]]);
    header("location:products.php");
}