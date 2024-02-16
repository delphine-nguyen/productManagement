<?php

require_once("./model/Category.php");

class Product
{
    private int $id;
    private string $name;
    private float $price;
    private string $ref;
    private string $description;
    private Category $category;

    public function __construct(
        int $id,
        string $name,
        float $price,
        string $ref,
        string $description,
        Category $category
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->ref = $ref;
        $this->description = $description;
        $this->category = $category;
    }


    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of price
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param float $price
     *
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get the value of ref
     *
     * @return string
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * Set the value of ref
     *
     * @param string $ref
     *
     * @return self
     */
    public function setRef(string $ref): self
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * Get the value of description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function __toString(): string
    {
        return "ID: " . $this->getId() . "<br>" .
            "REF: " . $this->getRef() . "<br>" .
            "Name: " . $this->getName() . "<br>" .
            "Category: " . $this->category->getLabel() . "<br>" .
            "Price: " . $this->getPrice() . "€<br>" .
            "Description: " . $this->getDescription() . "<br>";
    }

    /**
     * Get the value of category
     *
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param Category $category
     *
     * @return self
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }
}
