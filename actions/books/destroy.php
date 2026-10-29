<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/book-repository.php";

if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === "GET") {
    $id = $_GET['id'];

    deleteBook($id);

    header('Location: ../../pages/books/index.php');
    exit();
}

header('Location: ../../pages/books/index.php');
exit();
