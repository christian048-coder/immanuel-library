<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors'], $_SESSION['old']);

$pageTitle = "Tambah Kategori";
$pageSubtitle = "Buat kategori baru untuk mengelompokkan buku";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Kategori - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/categories/create.css">
</head>
<body>
  <div class="app-shell">
  <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
          <ul>
            <?php foreach ($errors as $error): ?>
              <li><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <form method="POST" action="../../actions/categories/store.php">
          <div class="form-card">
            <div class="form-section-title">Data Kategori</div>
            <div class="form-group">
              <label for="name">Nama Kategori</label>
              <input type="text" id="name" name="name" placeholder="Contoh: Fiksi" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
              <?php if (isset($errors['name'])): ?>
                <span class="error-message"><?= $errors['name'] ?></span>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea id="description" name="description" rows="3" placeholder="Deskripsi singkat kategori"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
              <?php if (isset($errors['description'])): ?>
                <span class="error-message"><?= $errors['description'] ?></span>
              <?php endif; ?>
            </div>

            <div class="form-actions">
              <a href="index.php" class="btn btn-outline">Batal</a>
              <button type="submit" name="store" class="btn btn-primary">Simpan Kategori</button>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>