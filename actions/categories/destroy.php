<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/category-repository.php";

if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === "GET") {
    $id = $_GET['id'];

    deleteCategory($id);

    header('Location: ../../pages/categories/index.php');
    exit();
}

header('Location: ../../pages/categories/index.php');
exit();
