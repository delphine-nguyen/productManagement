<?php

require_once("./DAO/IProductDAO.php");
require_once("./utils/DBConnect.php");
require_once("./model/Category.php");
require_once("./DAO/ICategoryDAO.php");

class CategoryDAOImp implements ICategoryDAO
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

    public function getAllCategories(): array
    {
        $categories = [];
        $query = "SELECT * FROM categories;";

        try {
            $statement = $this->conn->getPdo()->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            var_dump($result);

            if (count($result) > 0) {
                foreach ($result as $row) {
                    $categories[] = new Category(
                        id: $row["id"],
                        label: $row["label"],
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $categories;
    }

    public function getCategoryId(string $label)
    {
        $id = null;

        $query = "SELECT id
                FROM categories
                WHERE label=:label";
        try {
            $statement = $this->conn->getPdo()->prepare($query);
            $statement->bindParam(":label", $label);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $id =  intval($result["id"]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $id;
    }
    public function getCategoryLabel(int $id)
    {
        $label = null;

        $query = "SELECT label
                FROM categories
                WHERE id=:id";
        try {
            $statement = $this->conn->getPdo()->prepare($query);
            $statement->bindParam(":id", $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $label =  $result["label"];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $label;
    }

    /**
     * Get the value of conn
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * Set the value of conn
     */
    public function setConn($conn): self
    {
        $this->conn = $conn;
        return $this;
    }
}
