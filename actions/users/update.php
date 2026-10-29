<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/user-repository.php";
require_once __DIR__ . "/../../validations/user-validations.php";

session_start();

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $data = [
        'id' => $_POST['id'] ?? '',
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'role' => $_POST['role'] ?? ''
    ];

    $errors = validateUserUpdate($data);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header('Location: ../../pages/users/edit.php?id=' . $data['id']);
        exit();
    }

    $result = updateUser($data);

    if ($result) {
        header('Location: ../../pages/users/index.php');
        exit();
    } else {
        $_SESSION['errors'] = ['database' => 'Gagal memperbarui pengguna'];
        header('Location: ../../pages/users/edit.php?id=' . $data['id']);
        exit();
    }
}

header('Location: ../../pages/users/index.php');
exit();
