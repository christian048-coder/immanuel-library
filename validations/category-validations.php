<?php

function validateCategory($data)
{
    $errors = [];

    // Name validation
    if (empty($data['name'])) {
        $errors['name'] = "Nama kategori wajib diisi";
    } elseif (strlen($data['name']) < 3) {
        $errors['name'] = "Nama kategori minimal 3 karakter";
    }

    // Description validation
    if (empty($data['description'])) {
        $errors['description'] = "Deskripsi kategori wajib diisi";
    }

    return $errors;
}

function validateCategoryUpdate($data)
{
    $errors = [];

    // Name validation
    if (empty($data['name'])) {
        $errors['name'] = "Nama kategori wajib diisi";
    } elseif (strlen($data['name']) < 3) {
        $errors['name'] = "Nama kategori minimal 3 karakter";
    }

    // Description validation
    if (empty($data['description'])) {
        $errors['description'] = "Deskripsi kategori wajib diisi";
    }

    return $errors;
}
