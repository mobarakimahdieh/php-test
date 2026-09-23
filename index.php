<?php

require_once "Product.php";
require_once "Inventory.php";

$inventory = new Inventory();

$product1 = new Product("Laptop", 50000, 2);
$product2 = new Product("Mouse", 1000, 3);
$product3 = new Product("Keyboard", 2000, 1);

$inventory->add($product1);
$inventory->add($product2);
$inventory->add($product3);

echo "سه محصول اضافه شدند." . "<br>";

$inventory->remove("Mouse");

echo "محصول Mouse حذف شد." . "<br>";

$foundProduct = $inventory->find("Laptop");

if ($foundProduct !== null) {
    echo "محصول پیدا شد: " . $foundProduct->getName() . "<br>";
} else {
    echo "محصول پیدا نشد." . "<br>";
}

$notFoundProduct = $inventory->find("Phone");

if ($notFoundProduct !== null) {
    echo "محصول پیدا شد: " . $notFoundProduct->getName() . "<br>";
} else {
    echo "محصول Phone پیدا نشد." . "<br>";
}

echo "ارزش کل موجودی: " . $inventory->getTotalValue();



?>