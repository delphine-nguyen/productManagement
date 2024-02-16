<?php

interface ICategoryDAO
{
    public function getAllCategories(): array;
    public function getCategoryId(string $label);
    public function getCategoryLabel(int $id);
}
