<?php

function validateAuthor($data)
{
    $errors = [];

    // Name validation
    if (empty($data['name'])) {
        $errors['name'] = "Nama penulis wajib diisi";
    } elseif (strlen($data['name']) < 3) {
        $errors['name'] = "Nama penulis minimal 3 karakter";
    }

    // Bio validation
    if (empty($data['bio'])) {
        $errors['bio'] = "Bio penulis wajib diisi";
    }

    return $errors;
}

function validateAuthorUpdate($data)
{
    $errors = [];

    // Name validation
    if (empty($data['name'])) {
        $errors['name'] = "Nama penulis wajib diisi";
    } elseif (strlen($data['name']) < 3) {
        $errors['name'] = "Nama penulis minimal 3 karakter";
    }

    // Bio validation
    if (empty($data['bio'])) {
        $errors['bio'] = "Bio penulis wajib diisi";
    }

    return $errors;
}
