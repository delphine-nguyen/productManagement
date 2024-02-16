<?php

require_once("./model/Product.php");

interface IProductDAO
{
    public function getAllProducts(): array;
    public function getProductById(int $id);
    public function getProductByName(string $name);
    public function getProductsBetweenPrices(int $min, int $max): array;
    public function createProduct(string $name, float $price, string $description, string $ref, string $category);

    public function editProduct(int $id, string $name, float $price, string $description, string $ref, string $category): string;

    public function deleteProduct(int $id): string;
}
