<?php
require_once("./utils/DBconnect.php");
require_once("./DAO/imp/ProductDAOImp.php");
require_once("./utils/FormValidation.php");

if (isset($_POST["submit"])) {

    session_start();
    if (FormValidation::validate(
        fields: ["name", "ref", "description", "price", "category"],
        form: $_POST
    )) {

        $id = $_SESSION["id"];
        $name = FormValidation::cleanData($_POST["name"]);
        $price = FormValidation::cleanData($_POST["price"]);
        $description = FormValidation::cleanData($_POST["description"]);
        $ref = FormValidation::cleanData($_POST["ref"]);
        $category = FormValidation::cleanData($_POST["category"]);
        var_dump($category);

        $productDAO = new ProductDAOImp();

        $_SESSION["display"] = $productDAO->editProduct(
            id: $id,
            name: $name,
            price: $price,
            description: $description,
            ref: $ref,
            category: $category
        );
    } else {
        $_SESSION["display"] = "Supply all fields";
    }

    header("Location: ./index.php");
    exit();
}
