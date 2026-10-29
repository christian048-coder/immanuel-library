<?php

function validateUser($data)
{
    $errors = [];

    // Name validation
    if (empty($data['name'])) {
        $errors['name'] = "Nama lengkap wajib diisi";
    } elseif (strlen($data['name']) < 3) {
        $errors['name'] = "Nama lengkap minimal 3 karakter";
    }

    // Email validation
    if (empty($data['email'])) {
        $errors['email'] = "Email wajib diisi";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid";
    }

    // Password validation
    if (empty($data['password'])) {
        $errors['password'] = "Password wajib diisi";
    } elseif (strlen($data['password']) < 8) {
        $errors['password'] = "Password minimal 8 karakter";
    }

    // Role validation
    if (empty($data['role'])) {
        $errors['role'] = "Role wajib dipilih";
    }

    return $errors;
}

function validateUserUpdate($data)
{
    $errors = [];

    // Name validation
    if (empty($data['name'])) {
        $errors['name'] = "Nama lengkap wajib diisi";
    } elseif (strlen($data['name']) < 3) {
        $errors['name'] = "Nama lengkap minimal 3 karakter";
    }

    // Email validation
    if (empty($data['email'])) {
        $errors['email'] = "Email wajib diisi";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid";
    }

    // Role validation
    if (empty($data['role'])) {
        $errors['role'] = "Role wajib dipilih";
    }

    return $errors;
}

function validateProfile($data)
{
    $errors = [];

    // Name validation
    if (empty($data['name'])) {
        $errors['name'] = "Nama lengkap wajib diisi";
    } elseif (strlen($data['name']) < 3) {
        $errors['name'] = "Nama lengkap minimal 3 karakter";
    }

    // Email validation
    if (empty($data['email'])) {
        $errors['email'] = "Email wajib diisi";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid";
    }

    // Phone validation
    if (empty($data['phone'])) {
        $errors['phone'] = "Nomor telepon wajib diisi";
    }

    // Address validation
    if (empty($data['address'])) {
        $errors['address'] = "Alamat wajib diisi";
    }

    // Bio validation
    if (empty($data['bio'])) {
        $errors['bio'] = "Bio singkat wajib diisi";
    }

    return $errors;
}
