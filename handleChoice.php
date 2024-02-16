<?php

require_once("./utils/FormValidation.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    session_start();
    $_SESSION["display"] = "";
    switch (strtolower($_GET["choice"])) {
        case "add product":
            header("Location: ./formCreateProduct.php");
            exit();
        case "search name":

            if (FormValidation::validate(form: $_GET, fields: ["searchName"])) {
                $_SESSION["searchName"] = FormValidation::cleanData($_GET["searchName"]);
                header("Location: ./searchName.php");
                exit();
            }
        case "search price":
            if (FormValidation::validate(form: $_GET, fields: ["minPrice", "maxPrice"])) {
                $_SESSION["minPrice"] = FormValidation::cleanData($_GET["minPrice"]);
                $_SESSION["maxPrice"] = FormValidation::cleanData($_GET["maxPrice"]);
                header("Location: ./searchPrice.php");
                exit();
            }
        case "delete":
            if (FormValidation::validate(form: $_GET, fields: ["id"])) {
                $_SESSION["id"] = FormValidation::cleanData($_GET["id"]);
                header("Location: ./deleteProduct.php");
                exit();
            }
        case "edit":
            if (FormValidation::validate(form: $_GET, fields: ["id"])) {
                $_SESSION["id"] = FormValidation::cleanData($_GET["id"]);
                header("Location: ./formEditProduct.php");
                exit();
            }
        default:
            header("Location: ./index.php");
            exit();
    }
}
