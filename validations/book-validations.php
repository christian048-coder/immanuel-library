<?php

function validateBook($data)
{
    $errors = [];

    // Title validation
    if (empty($data['title'])) {
        $errors['title'] = "Judul buku wajib diisi";
    } elseif (strlen($data['title']) < 3) {
        $errors['title'] = "Judul buku minimal 3 karakter";
    }

    // ISBN validation
    if (empty($data['isbn'])) {
        $errors['isbn'] = "ISBN wajib diisi";
    }

    // Year validation
    if (empty($data['year'])) {
        $errors['year'] = "Tahun terbit wajib diisi";
    } elseif (!is_numeric($data['year'])) {
        $errors['year'] = "Tahun terbit harus berupa angka";
    }

    // Stock validation
    if (empty($data['stock'])) {
        $errors['stock'] = "Jumlah stok wajib diisi";
    } elseif (!is_numeric($data['stock'])) {
        $errors['stock'] = "Jumlah stok harus berupa angka";
    }

    // Category validation
    if (empty($data['category_id'])) {
        $errors['category_id'] = "Kategori wajib dipilih";
    }

    // Description validation
    if (empty($data['description'])) {
        $errors['description'] = "Deskripsi wajib diisi";
    }

    // Author validation
    if (empty($data['author_ids']) || count($data['author_ids']) === 0) {
        $errors['author_ids'] = "Pilih setidaknya satu penulis";
    }

    return $errors;
}

function validateBookUpdate($data)
{
    $errors = [];

    // Title validation
    if (empty($data['title'])) {
        $errors['title'] = "Judul buku wajib diisi";
    } elseif (strlen($data['title']) < 3) {
        $errors['title'] = "Judul buku minimal 3 karakter";
    }

    // ISBN validation
    if (empty($data['isbn'])) {
        $errors['isbn'] = "ISBN wajib diisi";
    }

    // Year validation
    if (empty($data['year'])) {
        $errors['year'] = "Tahun terbit wajib diisi";
    } elseif (!is_numeric($data['year'])) {
        $errors['year'] = "Tahun terbit harus berupa angka";
    }

    // Stock validation
    if (empty($data['stock'])) {
        $errors['stock'] = "Jumlah stok wajib diisi";
    } elseif (!is_numeric($data['stock'])) {
        $errors['stock'] = "Jumlah stok harus berupa angka";
    }

    // Category validation
    if (empty($data['category_id'])) {
        $errors['category_id'] = "Kategori wajib dipilih";
    }

    return $errors;
}
?>