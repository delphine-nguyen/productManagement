<?php
require_once("./model/Category.php");
require_once("./DAO/imp/CategoryDAOImp.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        input,
        label {
            display: block;
        }
    </style>
    <title>Add product</title>
</head>

<body>
    <header>
        <h2>Add product</h2>
    </header>
    <main>
        <form action="./createProduct.php" method="post">
            <label for="name">Name</label>
            <input type="text" name="name">

            <label for="ref">REF</label>
            <input type="text" name="ref" max=5>

            <label for="price">Price</label>
            <input type="number" name="price">

            <label for="description">Description</label>
            <textarea name="description" cols="30" rows="10"></textarea>

            <label for="category">Category</label>
            <select name="category">
                <?php
                $categoryDAO = new CategoryDAOImp();
                $categories = $categoryDAO->getAllCategories();

                foreach ($categories as $category) : ?>
                    <option value="<?php echo $category->getLabel() ?>"><?php echo $category->getLabel() ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="submit">Add product</button>
        </form>
        <section id="display">
            <?php
            session_start();
            if (isset($_SESSION["display"]) && !empty($_SESSION["display"])) {
                echo $_SESSION["display"];
            } ?>
        </section>
    </main>

</body>

</html>