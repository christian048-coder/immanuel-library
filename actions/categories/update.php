<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/category-repository.php";
require_once __DIR__ . "/../../validations/category-validations.php";

session_start();

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $data = [
        'id' => $_POST['id'] ?? '',
        'name' => $_POST['name'] ?? '',
        'description' => $_POST['description'] ?? ''
    ];

    $errors = validateCategoryUpdate($data);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header('Location: ../../pages/categories/edit.php?id=' . $data['id']);
        exit();
    }

    $result = updateCategory($data);

    if ($result) {
        header('Location: ../../pages/categories/index.php');
        exit();
    } else {
        $_SESSION['errors'] = ['database' => 'Gagal memperbarui kategori'];
        header('Location: ../../pages/categories/edit.php?id=' . $data['id']);
        exit();
    }
}

header('Location: ../../pages/categories/index.php');
exit();
