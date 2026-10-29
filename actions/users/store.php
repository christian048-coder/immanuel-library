<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/user-repository.php";
require_once __DIR__ . "/../../validations/user-validations.php";

session_start();

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $data = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'role' => $_POST['role'] ?? ''
    ];

    $errors = validateUser($data);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header('Location: ../../pages/users/create.php');
        exit();
    }

    $result = storeUser($data);

    if ($result) {
        header('Location: ../../pages/users/index.php');
        exit();
    } else {
        $_SESSION['errors'] = ['database' => 'Gagal menyimpan pengguna'];
        $_SESSION['old'] = $data;
        header('Location: ../../pages/users/create.php');
        exit();
    }
}

header('Location: ../../pages/users/create.php');
exit();
