<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/category-repository.php";
require_once __DIR__ . "/../../validations/category-validations.php";

session_start();

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $data = [
        'name' => $_POST['name'] ?? '',
        'description' => $_POST['description'] ?? ''
    ];

    $errors = validateCategory($data);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header('Location: ../../pages/categories/create.php');
        exit();
    }

    $result = storeCategory($data);

    if ($result) {
        header('Location: ../../pages/categories/index.php');
        exit();
    } else {
        $_SESSION['errors'] = ['database' => 'Gagal menyimpan kategori'];
        $_SESSION['old'] = $data;
        header('Location: ../../pages/categories/create.php');
        exit();
    }
}

header('Location: ../../pages/categories/create.php');
exit();
