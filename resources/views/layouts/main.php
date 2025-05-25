<!DOCTYPE html>
<html>
  <head>
      <title><?= htmlspecialchars($title) ?? 'Aplikasi MVC'; ?></title>
  </head>
  <body>

    <?php include __DIR__ . '/header.php'; ?>

    <main>
        <?php include $viewFile; ?>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>

  </body>
</html>