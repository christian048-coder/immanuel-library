<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors'], $_SESSION['old']);

$pageTitle = "Tambah Pengguna";
$pageSubtitle = "Buat akun pengguna baru beserta perannya";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Pengguna - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/users/create.css">
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

        <form method="POST" action="../../actions/users/store.php">
          <div class="form-card">
            <div class="form-section-title">Data Pengguna</div>
            <div class="form-row">
              <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Contoh: Siti Aminah" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
                <?php if (isset($errors['name'])): ?>
                  <span class="error-message"><?= $errors['name'] ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="nama@sekolah.sch.id" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                <?php if (isset($errors['email'])): ?>
                  <span class="error-message"><?= $errors['email'] ?></span>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Kata sandi awal" value="<?= htmlspecialchars($old['password'] ?? '') ?>">
                <?php if (isset($errors['password'])): ?>
                  <span class="error-message"><?= $errors['password'] ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                  <option value="member" <?= ($old['role'] ?? '') == 'member' ? 'selected' : '' ?>>Member</option>
                  <option value="admin" <?= ($old['role'] ?? '') == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
                <?php if (isset($errors['role'])): ?>
                  <span class="error-message"><?= $errors['role'] ?></span>
                <?php endif; ?>
              </div>
            </div>

            <div class="form-actions">
              <a href="index.php" class="btn btn-outline">Batal</a>
              <button type="submit" name="store" class="btn btn-primary">Simpan Pengguna</button>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>