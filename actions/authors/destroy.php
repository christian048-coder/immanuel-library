<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/author-repository.php";

if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === "GET") {
    $id = $_GET['id'];

    deleteAuthor($id);

    header('Location: ../../pages/authors/index.php');
    exit();
}

header('Location: ../../pages/authors/index.php');
exit();
