<?php

require_once "Product.php";

class Inventory
{
    private array $products = [];

    public function add(Product $p): void
    {
        $this->products[] = $p;
    }

    public function remove(string $name): void
    {
        foreach ($this->products as $key => $product) {

            if ($product->getName() === $name) {
                unset($this->products[$key]);
                return;
            }
        }
    }

    public function find(string $name): ?Product
    {
        foreach ($this->products as $product) {

            if ($product->getName() === $name) {
                return $product;
            }
        }

        return null;
    }

    public function getTotalValue(): float
    {
        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->getTotal();
        }

        return $total;
    }
}




?>