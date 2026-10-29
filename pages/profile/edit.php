<?php
session_start();

require_once __DIR__ . "/../../repositories/user-repository.php";

$userId = $_SESSION['user_id'] ?? 2;
$user = getUser($userId);
$profile = getProfile($userId);

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors'], $_SESSION['old']);

$pageTitle = "Profil Saya";
$pageSubtitle = "Kelola data akun dan profil Anda";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Saya - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/profile/edit.css">
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

        <form method="POST" action="../../actions/profile/update.php">
          <div class="form-card" style="margin-bottom:20px;">
            <div class="form-section-title">Data Akun</div>
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
            <div class="form-group">
              <label>Role</label>
              <input type="text" value="<?= ucfirst($user['role']) ?>" disabled>
              <p class="form-help">Role hanya dapat diubah oleh Admin melalui menu Manajemen Pengguna.</p>
            </div>
          </div>

          <div class="form-card">
            <div class="form-section-title">Data Profil</div>
            <div class="form-group">
              <label for="phone">Nomor Telepon</label>
              <input type="text" id="phone" name="phone" value="<?= $profile['phone'] ?>">
                <?php if (isset($errors['phone'])): ?>
                  <span class="error-message"><?= $errors['phone'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="address">Alamat</label>
              <input type="text" id="address" name="address" value="<?= $profile['address'] ?>">
                <?php if (isset($errors['address'])): ?>
                  <span class="error-message"><?= $errors['address'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="bio">Bio Singkat</label>
              <textarea id="bio" name="bio" rows="3"><?= $profile['bio'] ?></textarea>
                <?php if (isset($errors['bio'])): ?>
                  <span class="error-message"><?= $errors['bio'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-actions">
              <button type="button" class="btn btn-outline">Batal</button>
              <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>