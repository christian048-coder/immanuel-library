<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/author-repository.php";
require_once __DIR__ . "/../../validations/author-validations.php";

session_start();

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $data = [
        'id' => $_POST['id'] ?? '',
        'name' => $_POST['name'] ?? '',
        'bio' => $_POST['bio'] ?? ''
    ];

    $errors = validateAuthorUpdate($data);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header('Location: ../../pages/authors/edit.php?id=' . $data['id']);
        exit();
    }

    $result = updateAuthor($data);

    if ($result) {
        header('Location: ../../pages/authors/index.php');
        exit();
    } else {
        $_SESSION['errors'] = ['database' => 'Gagal memperbarui penulis'];
        header('Location: ../../pages/authors/edit.php?id=' . $data['id']);
        exit();
    }
}

header('Location: ../../pages/authors/index.php');
exit();
