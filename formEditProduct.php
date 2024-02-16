<?php
require_once("./utils/DBconnect.php");
require_once("./DAO/imp/ProductDAOImp.php");
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
    <title>Document</title>
</head>

<body>
    <main>
        <?php
        session_start();
        $id = $_SESSION["id"];

        $productDAO = new ProductDAOImp();

        $product = $productDAO->getProductById($id);
        if (!$product instanceof Product) {
            $_SESSION["display"] = "No product with ID $id";
            header("Location: ./index.php");
            exit();
        }
        ?>

        <form action='./editProduct.php' method='post'>

            <label for='name'>Name</label>
            <input type='text' name='name' value='<?php echo $product->getName() ?>'>

            <label for='ref'>REF</label>
            <input type='text' name='ref' value='<?php echo $product->getRef() ?>'>

            <label for="category">Category</label>
            <select name="category">
                <?php
                $categoryDAO = new CategoryDAOImp();
                $categories = $categoryDAO->getAllCategories();

                foreach ($categories as $category) : ?>
                    <option value="<?php echo $category->getLabel() ?>" <?php if ($category->getLabel() == $product->getCategory()->getLabel()) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $category->getLabel() ?></option>
                <?php endforeach; ?>
            </select>

            <label for='price'>Price</label>
            <input type='number' name='price' value='<?php echo $product->getPrice() ?>'>

            <label for='description'>Description</label>
            <textarea name="description" cols="30" rows="10"><?php echo $product->getDescription() ?></textarea>

            <button type='submit' name='submit'>Save</button>

        </form>

    </main>
</body>

</html>