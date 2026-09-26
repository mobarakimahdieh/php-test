<?php

require 'TodoList.php';

$todoList = new TodoList();

$editTodo = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    if ($action === 'add') {

        $title = trim($_POST['title'] ?? '');

        if ($title === '') {
            $error = 'عنوان کار نمی‌تواند خالی باشد.';
        } else {
            $todoList->add($title);
        }
    }

    elseif ($action === 'update') {

        $id = (int) ($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');

        if ($title === '') {
            $error = 'عنوان کار نمی‌تواند خالی باشد.';
        } else {
            $todoList->update($id, $title);
        }
    }

    elseif ($action === 'delete') {

        $id = (int) ($_POST['id'] ?? 0);

        $todoList->delete($id);
    }

    elseif ($action === 'toggle') {

        $id = (int) ($_POST['id'] ?? 0);

        $todoList->toggle($id);
    }
}

$todos = $todoList->all();

if (isset($_GET['edit'])) {

    $editId = (int) $_GET['edit'];

    foreach ($todos as $todo) {
        if ($todo['id'] === $editId) {
            $editTodo = $todo;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لیست کارها</title>
</head>

<body>

<h1>لیست کارها</h1>

<?php if ($error): ?>

    <p>
        <?= htmlspecialchars($error) ?>
    </p>

<?php endif; ?>


<?php if ($editTodo): ?>

    <h2>ویرایش کار</h2>

    <form method="POST">

        <input
            type="hidden"
            name="action"
            value="update"
        >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $editTodo['id'] ?>"
        >

        <input
            type="text"
            name="title"
            value="<?= htmlspecialchars($editTodo['title']) ?>"
        >

        <button type="submit">
            ذخیره
        </button>

    </form>

<?php else: ?>

    <h2>افزودن کار</h2>

    <form method="POST">

        <input
            type="hidden"
            name="action"
            value="add"
        >

        <input
            type="text"
            name="title"
            placeholder="عنوان کار"
        >

        <button type="submit">
            افزودن
        </button>

    </form>

<?php endif; ?>


<hr>


<h2>کارها</h2>

<ul>

<?php foreach ($todos as $todo): ?>

    <li>

        <?php if ($todo['done']): ?>

            <del>
                <?= htmlspecialchars($todo['title']) ?>
            </del>

        <?php else: ?>

            <?= htmlspecialchars($todo['title']) ?>

        <?php endif; ?>


        <!-- تغییر وضعیت -->

        <form method="POST" style="display:inline;">

            <input
                type="hidden"
                name="action"
                value="toggle"
            >

            <input
                type="hidden"
                name="id"
                value="<?= (int) $todo['id'] ?>"
            >

            <button type="submit">

                <?= $todo['done'] ? 'برگشت' : 'انجام شد' ?>

            </button>

        </form>


        <!-- ویرایش -->

        <a href="?edit=<?= (int) $todo['id'] ?>">
            ویرایش
        </a>


        <!-- حذف -->

        <form method="POST" style="display:inline;">

            <input
                type="hidden"
                name="action"
                value="delete"
            >

            <input
                type="hidden"
                name="id"
                value="<?= (int) $todo['id'] ?>"
            >

            <button type="submit">
                حذف
            </button>

        </form>

    </li>

<?php endforeach; ?>

</ul>

</body>
</html>