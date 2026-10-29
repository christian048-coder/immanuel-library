<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/book-repository.php";
require_once __DIR__ . "/../../validations/book-validations.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $data = [
        'title' => $_POST['title'] ?? '',
        'isbn' => $_POST['isbn'] ?? '',
        'year' => $_POST['year'] ?? '',
        'stock' => $_POST['stock'] ?? '',
        'description' => $_POST['description'] ?? '',
        'category_id' => $_POST['category_id'] ?? '',
        'author_ids' => $_POST['author_ids'] ?? []
    ];

    $errors = validateBook($data);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header('Location: ../../pages/books/create.php');
        exit();
    }

    $result = storeBook($data);

    if ($result) {
        header('Location: ../../pages/books/index.php');
        exit();
    } else {
        $_SESSION['errors'] = ['database' => 'Gagal menyimpan buku'];
        $_SESSION['old'] = $data;
        header('Location: ../../pages/books/create.php');
        exit();
    }
}

header('Location: ../../pages/books/create.php');
exit();
