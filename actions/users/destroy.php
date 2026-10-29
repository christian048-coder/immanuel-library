<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/user-repository.php";

if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === "GET") {
    $id = $_GET['id'];

    deleteUser($id);

    header('Location: ../../pages/users/index.php');
    exit();
}

header('Location: ../../pages/users/index.php');
exit();
