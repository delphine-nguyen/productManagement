<?php

require_once("./model/Product.php");
require_once("./utils/DBConnect.php");
require_once("./DAO/imp/ProductDAOImp.php");
require_once("./utils/FormValidation.php");

session_start();

$id = $_SESSION["id"];

$productDAO = new ProductDAOImp();
$_SESSION["display"] = $productDAO->deleteProduct(id: $id);
header("Location: ./index.php");
exit();
