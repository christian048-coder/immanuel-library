<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/user-repository.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = [
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? ''
    ];

    $errors = [];

    // Validate email
    if (empty($request['email'])) {
        $errors['email'] = "Email wajib diisi";
    } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid";
    }

    // Validate password
    if (empty($request['password'])) {
        $errors['password'] = "Password wajib diisi";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $request;
        header('Location: ../../pages/auth/login.php');
        exit();
    }

    // Check user
    $user = getUserByEmail($request['email']);

    if ($user && password_verify($request['password'], $user['password'])) {
        // Clear previous errors
        unset($_SESSION['errors'], $_SESSION['old']);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header('Location: ../../pages/books/index.php');
        } else {
            header('Location: ../../pages/profile/edit.php');
        }
        exit();
    } else {
        $_SESSION['errors'] = ['email' => "Email atau kata sandi salah"];
        $_SESSION['old'] = $request;
        header('Location: ../../pages/auth/login.php');
        exit();
    }
}

header('Location: ../../pages/auth/login.php');
exit();
