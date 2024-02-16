<?php

require_once("./model/Product.php");
require_once("./utils/DBConnect.php");
require_once("./DAO/imp/ProductDAOImp.php");
require_once("./utils/FormValidation.php");

session_start();

$productDAO = new ProductDAOImp();
$products = $productDAO->getProductByName($_SESSION["searchName"]);

$display = "";
if (count($products) > 0) {
    foreach ($products as $product) {
        $display .= $product . "---<br>";
    }
} else {
    $display = "No result found";
}

$_SESSION["display"] = $display;

header("Location: ./index.php");
exit();
