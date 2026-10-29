<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/user-repository.php";
require_once __DIR__ . "/../../validations/user-validations.php";

session_start();

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    $userId = $_SESSION['user_id'] ?? 2;

    $data = [
        'user_id' => $userId,
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'address' => $_POST['address'] ?? '',
        'bio' => $_POST['bio'] ?? ''
    ];

    $errors = validateProfile($data);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header('Location: ../../pages/profile/edit.php');
        exit();
    }

    $result = updateProfile($data);

    if ($result) {
        header('Location: ../../pages/profile/edit.php');
        exit();
    } else {
        $_SESSION['errors'] = ['database' => 'Gagal memperbarui profil'];
        header('Location: ../../pages/profile/edit.php');
        exit();
    }
}

header('Location: ../../pages/profile/edit.php');
exit();
