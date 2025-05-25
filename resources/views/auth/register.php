<!-- 
  buat tampilan halaman form register
  ingat, halaman register berkolaborasi dengan template auth

  tambahkan div untuk menampilkan pesan error
-->

<h2><?= htmlspecialchars($title) ?></h2>

<?php if (isset($error)): ?>
  <div><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form action="?c=auth&m=registerProcess" method="post">
    <label for="name">Username:</label><br>
    <input type="text" name="name" required value="<?= htmlspecialchars($name ?? '') ?>"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label for="confirm_password">Confirm Password:</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <button type="submit">Register</button>
</form>

<p>Sudah punya akun? <a href="?c=auth&m=login">Login di sini</a></p>
