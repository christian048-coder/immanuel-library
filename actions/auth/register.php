<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../repositories/user-repository.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'role' => 'member'
    ];

    // Validation rules
    $errors = [];

    // Check required fields
    if (empty($request['name'])) {
        $errors['name'] = "Nama lengkap wajib diisi";
    } elseif (strlen($request['name']) < 3) {
        $errors['name'] = "Nama minimal 3 karakter";
    }

    if (empty($request['email'])) {
        $errors['email'] = "Email wajib diisi";
    } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid";
    }

    if (empty($request['password'])) {
        $errors['password'] = "Password wajib diisi";
    } elseif (strlen($request['password']) < 8) {
        $errors['password'] = "Password minimal 8 karakter";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $request;
        header('Location: /pages/auth/register.php');
        exit();
    }

    // Check if email already exists
    $existing = getUserByEmail($request['email']);
    if ($existing) {
        $_SESSION['errors']['email'] = "Email sudah terdaftar";
        $_SESSION['old'] = $request;
        header('Location: /pages/auth/register.php');
        exit();
    }

    // Store user (storeUser will hash the password)
    $data = [
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => $request['password'],
        'role' => 'member'
    ];

    $result = storeUser($data);

    if ($result) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan masuk.";
    } else {
        $_SESSION['errors'] = ['database' => 'Gagal menyimpan registrasi'];
    }

    header('Location: /pages/auth/register.php');
    exit();
}

header('Location: /pages/auth/register.php');
exit();
