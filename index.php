<?php
require_once("./utils/DBConnect.php");
require_once("./DAO/imp/ProductDAOImp.php");
require_once("./model/Product.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
</head>

<body>
    <header>
        <h1>Product Management</h1>
    </header>

    <main>

        <section id="display">
            <?php
            session_start();
            if (isset($_SESSION["display"]) && !empty($_SESSION["display"])) {
                echo $_SESSION["display"];
            } ?>
        </section>

        <section id="filter">
            <form action="./handleChoice.php" method="get">
                <input type="submit" name="choice" value="Add product">
                <div>
                    <input type="text" name="searchName">
                    <input type="submit" value="Search name" name="choice">
                </div>

                <div>
                    <input type="number" name="minPrice" placeholder="Minimum">
                    <input type="number" name="maxPrice" placeholder="Maximum">
                    <input type="submit" value="Search price" name="choice">
                </div>
            </form>
        </section>

        <hr>

        <?php
        $productDAO = new ProductDAOImp();
        $products = $productDAO->getAllProducts();

        foreach ($products as $product) :
            echo $product; ?>
            <form method='get' action='handleChoice.php'>
                <input type="hidden" name="id" value="<?php echo $product->getId() ?>">
                <input type="submit" value="Edit" name="choice">
                <input type="submit" value="Delete" name="choice">
            </form>
            <hr>

        <?php endforeach; ?>

    </main>
</body>

</html>