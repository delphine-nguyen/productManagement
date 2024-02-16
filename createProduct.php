<?php

require_once("./model/Product.php");
require_once("./utils/DBConnect.php");
require_once("./DAO/imp/ProductDAOImp.php");
require_once("./utils/FormValidation.php");

if (isset($_POST["submit"])) {
    $display = "Supply all fields";
    if (FormValidation::validate(form: $_POST, fields: ["name", "ref", "price", "description", "category"])) {
        $name = FormValidation::cleanData($_POST["name"]);
        $ref = FormValidation::cleanData($_POST["ref"]);
        $price = FormValidation::cleanData($_POST["price"]);
        $description = FormValidation::cleanData($_POST["description"]);
        $category = FormValidation::cleanData($_POST["category"]);

        $productDAO = new ProductDAOImp();
        $display = $productDAO->createProduct(
            name: $name,
            ref: $ref,
            price: $price,
            description: $description,
            category: $category
        );
    }
    session_start();
    $_SESSION["display"] = $display;
    header("Location: ./formCreateProduct.php");
    exit();
}
