<?php

require_once("./DAO/IProductDAO.php");
require_once("./utils/DBConnect.php");
require_once("./model/Product.php");
require_once("./model/Category.php");
require_once("./DAO/imp/CategoryDAOImp.php");

class ProductDAOImp implements IProductDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = DBConnect::getInstance(
            dsn: "mysql:host=localhost; dbname=productmanagement",
            username: "root",
            password: ""
        );
    }


    public function getAllProducts(): array
    {
        $products = [];
        $query = "SELECT * FROM products;";

        try {
            $statement = $this->conn->getPdo()->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                $categoryDAO = new CategoryDAOImp();

                foreach ($result as $row) {
                    $category_id = $row["category_id"];

                    $category = new Category(
                        id: $category_id,
                        label: $categoryDAO->getCategoryLabel($category_id)
                    );

                    $products[] = new Product(
                        id: $row["id"],
                        name: $row["name"],
                        price: $row["price"],
                        ref: $row["ref"],
                        description: $row["description"],
                        category: $category
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $products;
    }
    public function getProductById(int $id)
    {
        $query = "SELECT * 
                FROM products
                WHERE id=:id;";

        try {
            $statement = $this->conn->getPdo()->prepare($query);
            $statement->bindParam("id", $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $categoryDAO = new CategoryDAOImp();
                $category_id = $result["category_id"];

                $category = new Category(
                    id: $category_id,
                    label: $categoryDAO->getCategoryLabel($category_id)
                );

                return new Product(
                    id: $result["id"],
                    name: $result["name"],
                    price: $result["price"],
                    ref: $result["ref"],
                    description: $result["description"],
                    category: $category,
                );
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return "No product with ID $id found";
    }
    public function getProductByName(string $name)
    {
        $query = "SELECT * 
                FROM products
                WHERE name LIKE :name;";

        $products = [];

        try {
            $statement = $this->conn->getPdo()->prepare($query);
            $statement->bindValue("name", "%$name%");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                $categoryDAO = new CategoryDAOImp();

                foreach ($result as $row) {
                    $category_id = $row["category_id"];

                    $category = new Category(
                        id: $category_id,
                        label: $categoryDAO->getCategoryLabel($category_id)
                    );
                    $products[] = new Product(
                        id: $row["id"],
                        name: $row["name"],
                        price: $row["price"],
                        ref: $row["ref"],
                        description: $row["description"],
                        category: $category,
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $products;
    }

    public function getProductsBetweenPrices(int $min, int $max): array
    {
        $products = [];

        $query = "SELECT * 
                FROM products
                WHERE price BETWEEN :min AND :max;";

        try {
            $statement = $this->conn->getPdo()->prepare($query);
            $statement->bindParam("min", $min);
            $statement->bindParam("max", $max);

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                $categoryDAO = new CategoryDAOImp();
                foreach ($result as $row) {
                    $category_id = $row["category_id"];

                    $category = new Category(
                        id: $category_id,
                        label: $categoryDAO->getCategoryLabel($category_id)
                    );
                    $products[] = new Product(
                        id: $row["id"],
                        name: $row["name"],
                        price: $row["price"],
                        ref: $row["ref"],
                        description: $row["description"],
                        category: $category
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $products;
    }

    public function createProduct(string $name, float $price, string $description, string $ref, string $category)
    {
        $query = "INSERT INTO products (name, ref, price, description, category_id)
                VALUES (:name, :ref, :price, :description, :categoryId);";

        try {
            $statement = $this->conn->getPdo()->prepare($query);

            $statement->bindParam("name", $name);
            $statement->bindParam("price", $price);
            $statement->bindParam("description", $description);
            $statement->bindParam("ref", $ref);

            $categoryDAO = new CategoryDAOImp();
            $categoryId = $categoryDAO->getCategoryId($category);
            $statement->bindParam("categoryId", $categoryId);

            if ($statement->execute()) {
                $display = "Product added successfully";
            }
        } catch (PDOException $e) {
            $display = "Couldn't add product";
        }
        return $display;
    }

    public function deleteProduct(int $id): string
    {
        $query = "DELETE FROM products
                WHERE id=:id;";

        try {
            $statement = $this->conn->getPdo()->prepare($query);
            $statement->bindParam(":id", $id);

            $statement->execute();
            $display = "Product deleted succesfully";
        } catch (PDOException $e) {
            $display = "Couldn't delete product";
        }

        return $display;
    }

    public function editProduct(
        int $id,
        string $name,
        float $price,
        string $description,
        string $ref,
        string $category
    ): string {


        $query = "UPDATE products
                    SET name=:name, 
                        price=:price, 
                        description=:description,
                        ref=:ref,
                        category_id=:categoryId
                    WHERE id=:id";

        try {
            $statement = $this->conn->getPdo()->prepare($query);

            $categoryDAO = new CategoryDAOImp();
            $categoryId = $categoryDAO->getCategoryId($category);
            var_dump($categoryId);

            $statement->bindParam(":id", $id);
            $statement->bindParam(":name", $name);
            $statement->bindParam(":price", $price);
            $statement->bindParam(":description", $description);
            $statement->bindParam(":ref", $ref);
            $statement->bindParam(":categoryId", $categoryId);

            $statement->execute();
            $display = "Product edited succesfully";
        } catch (PDOException $e) {
            // $display = "Couldn't edit product";
            $display = $e->getMessage();
        }
        return $display;
    }
}
