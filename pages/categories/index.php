<?php
session_start();

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['user_id'])) {
    header('Location: /pages/auth/login.php');
    exit();
}

require_once __DIR__ . "/../../repositories/category-repository.php";

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$filters = [];

$categories = getCategories($filters, $page, $perPage);
$totalCategories = countCategories($filters);
$totalPages = ceil($totalCategories / $perPage);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Kategori - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/categories/index.css">
</head>
<body>
  <div class="app-shell">
  <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <div class="toolbar">
          <form method="" action="" class="toolbar-filters">
            <div class="search-box">
              <svg class="icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
              <input type="text" name="search" class="search-input" placeholder="Cari nama kategori...">
            </div>
            <button type="submit" class="btn btn-outline btn-sm">Cari</button>
          </form>
          <a href="create.php" class="btn btn-primary">+ Tambah Kategori</a>
        </div>

        <div class="data-card">
          <table class="data-table">
            <thead>
              <tr>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah Buku</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categories as $category): ?>
                <tr>
                  <td>
                    <div class="cell-primary">
                      <span class="cell-thumb"><svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"/></svg></span>
                      <?= $category['name'] ?>
                    </div>
                  </td>
                  <td><?= $category['description'] ?></td>
                  <td><span class="badge badge-muted"><?= $category['total_books'] ?> buku</span></td>
                  <td>
                    <div class="cell-actions">
                      <a href="edit.php?id=<?= $category['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                      <a href="../../actions/categories/destroy.php?id=<?= $category['id'] ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
                    </div>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>

        <div class="pagination">
          <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" class="pagination-btn"><</a>
          <?php endif; ?>

          <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>" class="pagination-btn">></a>
          <?php endif; ?>

          <?php if ($totalPages > 1): ?>
            <span>
              Halaman <?= $page ?> dari <?= $totalPages ?>
            </span>
          <?php endif; ?>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
