<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/book-repository.php";
require_once __DIR__ . "/../../validations/book-validations.php";

session_start();

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $data = [
        'id' => $_POST['id'] ?? '',
        'title' => $_POST['title'] ?? '',
        'isbn' => $_POST['isbn'] ?? '',
        'year' => $_POST['year'] ?? '',
        'stock' => $_POST['stock'] ?? '',
        'category_id' => $_POST['category_id'] ?? '',
        'description' => $_POST['description'] ?? '',
        'author_ids' => $_POST['author_ids'] ?? []
    ];

    $errors = validateBookUpdate($data);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header('Location: ../../pages/books/edit.php?id=' . $data['id']);
        exit();
    }

    $result = updateBook($data);

    if ($result) {
        header('Location: ../../pages/books/index.php');
        exit();
    } else {
        $_SESSION['errors'] = ['database' => 'Gagal memperbarui buku'];
        header('Location: ../../pages/books/edit.php?id=' . $data['id']);
        exit();
    }
}

header('Location: ../../pages/books/index.php');
exit();
