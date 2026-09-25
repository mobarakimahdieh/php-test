<?php

$errors = [];
$success = "";

$name = "";
$price = "";
$quantity = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // دریافت اطلاعات فرم
    $name = trim($_POST["name"] ?? "");
    $price = trim($_POST["price"] ?? "");
    $quantity = trim($_POST["quantity"] ?? "");

    // اعتبارسنجی نام
    if ($name === "") {
        $errors["name"] = "نام الزامی است.";
    } elseif (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
        $errors["name"] = "نام باید بین ۲ تا ۱۰۰ کاراکتر باشد.";
    }

    // اعتبارسنجی قیمت
    if ($price === "") {
        $errors["price"] = "قیمت الزامی است.";
    } elseif (!is_numeric($price) || $price <= 0) {
        $errors["price"] = "قیمت باید یک عدد بزرگ‌تر از صفر باشد.";
    }

    // اعتبارسنجی تعداد
    if ($quantity === "") {
        $errors["quantity"] = "تعداد الزامی است.";
    } elseif (
        filter_var($quantity, FILTER_VALIDATE_INT) === false ||
        (int)$quantity < 0
    ) {
        $errors["quantity"] = "تعداد باید یک عدد صحیح و صفر یا بیشتر باشد.";
    }

    // اگر خطایی وجود نداشت
    if (empty($errors)) {

        // خواندن فایل JSON
        $json = file_get_contents("products.json");

        // تبدیل JSON به آرایه PHP
        $products = json_decode($json, true);

        // اگر فایل خالی یا خراب بود
        if (!is_array($products)) {
            $products = [];
        }

        // ساخت محصول جدید
        $product = [
            "name" => $name,
            "price" => (float)$price,
            "quantity" => (int)$quantity
        ];

        // اضافه کردن محصول به آرایه
        $products[] = $product;

        // تبدیل آرایه PHP به JSON
        $json = json_encode(
            $products,
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        );

        // ذخیره در فایل
        file_put_contents("products.json", $json);

        // پیام موفقیت
        $success = "محصول با موفقیت اضافه شد.";

        // خالی کردن فرم بعد از موفقیت
        $name = "";
        $price = "";
        $quantity = "";
    }
}

// خواندن محصولات برای نمایش
$json = file_get_contents("products.json");
$products = json_decode($json, true);

if (!is_array($products)) {
    $products = [];
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>افزودن محصول</title>
</head>

<body>

    <h1>افزودن محصول</h1>

    <?php if ($success !== ""): ?>
        <p>
            <?= htmlspecialchars($success) ?>
        </p>
    <?php endif; ?>


    <form method="POST">

        <!-- نام -->
        <div>
            <?php if (isset($errors["name"])): ?>
                <p>
                    <?= htmlspecialchars($errors["name"]) ?>
                </p>
            <?php endif; ?>

            <label for="name">نام محصول:</label>

            <input
                type="text"
                id="name"
                name="name"
                value="<?= htmlspecialchars($name) ?>"
            >
        </div>


        <!-- قیمت -->
        <div>
            <?php if (isset($errors["price"])): ?>
                <p>
                    <?= htmlspecialchars($errors["price"]) ?>
                </p>
            <?php endif; ?>

            <label for="price">قیمت:</label>

            <input
                type="number"
                id="price"
                name="price"
                value="<?= htmlspecialchars($price) ?>"
            >
        </div>


        <!-- تعداد -->
        <div>
            <?php if (isset($errors["quantity"])): ?>
                <p>
                    <?= htmlspecialchars($errors["quantity"]) ?>
                </p>
            <?php endif; ?>

            <label for="quantity">تعداد:</label>

            <input
                type="number"
                id="quantity"
                name="quantity"
                value="<?= htmlspecialchars($quantity) ?>"
            >
        </div>


        <button type="submit">
            افزودن محصول
        </button>

    </form>


    <hr>


    <h2>لیست محصولات</h2>

    <?php if (empty($products)): ?>

        <p>هنوز محصولی ثبت نشده است.</p>

    <?php else: ?>

        <table border="1">

            <thead>
                <tr>
                    <th>نام</th>
                    <th>قیمت</th>
                    <th>تعداد</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($products as $product): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($product["name"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string)$product["price"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars((string)$product["quantity"]) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</body>

</html>