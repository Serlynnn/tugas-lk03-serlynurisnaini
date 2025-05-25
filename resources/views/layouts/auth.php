<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($title ?? 'Auth Page') ?></title>
</head>
<body>
  <main>
    <?php include $viewFile; ?>
  </main>
  
  <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>