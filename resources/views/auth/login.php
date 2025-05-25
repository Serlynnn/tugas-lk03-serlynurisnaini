<h2><?= $title ?></h2>
<?php if (isset($error)): ?>
  <div><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form action="?c=auth&m=loginProcess" method="post">
    <label for="name">Username:</label><br>
    <input type="text" name="name" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="?c=auth&m=register">Daftar di sini</a></p>

