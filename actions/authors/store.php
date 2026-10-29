<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/author-repository.php";
require_once __DIR__ . "/../../validations/author-validations.php";

session_start();

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $data = [
        'name' => $_POST['name'] ?? '',
        'bio' => $_POST['bio'] ?? ''
    ];

    $errors = validateAuthor($data);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header('Location: ../../pages/authors/create.php');
        exit();
    }

    $result = storeAuthor($data);

    if ($result) {
        header('Location: ../../pages/authors/index.php');
        exit();
    } else {
        $_SESSION['errors'] = ['database' => 'Gagal menyimpan penulis'];
        $_SESSION['old'] = $data;
        header('Location: ../../pages/authors/create.php');
        exit();
    }
}

header('Location: ../../pages/authors/create.php');
exit();
