<?php
require_once __DIR__ . "/../../repositories/user-repository.php";

session_start();

$id = $_GET['id'] ?? '';
$user = getUser($id);

if (!$user) {
    header("Location: index.php");
    exit();
}

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors'], $_SESSION['old']);

$pageTitle = "Edit Pengguna";
$pageSubtitle = "Perbarui data dan role pengguna";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pengguna - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/users/edit.css">
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

        <form method="POST" action="../../actions/users/update.php">
          <input type="hidden" name="id" value="<?= $user['id'] ?>">
          <div class="form-card">
            <div class="form-section-title">Data Pengguna</div>
            <div class="form-row">
              <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="<?= $user['name'] ?>">
                <?php if (isset($errors['name'])): ?>
                  <span class="error-message"><?= $errors['name'] ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= $user['email'] ?>">
                <?php if (isset($errors['email'])): ?>
                  <span class="error-message"><?= $errors['email'] ?></span>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                <?php if (isset($errors['password'])): ?>
                  <span class="error-message"><?= $errors['password'] ?></span>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                  <option value="member" <?= $user['role'] === 'member' ? 'selected' : '' ?>>Member</option>
                  <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
                <?php if (isset($errors['role'])): ?>
                  <span class="error-message"><?= $errors['role'] ?></span>
                <?php endif; ?>
              </div>
            </div>

            <div class="form-actions">
              <a href="index.php" class="btn btn-outline">Batal</a>
              <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>