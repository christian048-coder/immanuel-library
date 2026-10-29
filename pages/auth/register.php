<?php
session_start();

$pageTitle = "Registrasi";
$pageSubtitle = "Buat akun baru untuk meminjam dan mengelola buku.";

// Handle errors from session
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/auth/register.css">
</head>
<body>

  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-logo">
        <span class="logo-badge">PD</span>
        Perpustakaan Digital
      </div>
      <h1>Buat Akun Baru</h1>
      <p class="auth-subtitle">Daftar untuk mulai meminjam dan mengelola buku.</p>

      <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach ($errors as $field => $error): ?>
            <li><?= $error ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>

      <?php if (!empty($_SESSION['success'] ?? false)): ?>
      <div class="alert alert-success">
        <p><?= $_SESSION['success'] ?></p>
      </div>
      <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <form method="POST" action="../../actions/auth/register.php">
        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" placeholder="Contoh: Budi Santoso" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
          <?php if (!empty($errors['name'] ?? false)): ?>
            <span class="error-message"><?= $errors['name'] ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="nama@sekolah.sch.id" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
          <?php if (!empty($errors['email'] ?? false)): ?>
            <span class="error-message"><?= $errors['email'] ?></span>
          <?php endif; ?>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" value="<?= htmlspecialchars($old['password'] ?? '') ?>">
            <?php if (!empty($errors['password'] ?? false)): ?>
              <span class="error-message"><?= $errors['password'] ?></span>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="password_confirmation">Ulangi Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" value="<?= htmlspecialchars($old['password_confirmation'] ?? '') ?>">
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
      </form>

      <p class="form-footer-link">
        Sudah punya akun? <a href="login.php">Masuk di sini</a>
      </p>
    </div>
  </div>
</body>
</html>
