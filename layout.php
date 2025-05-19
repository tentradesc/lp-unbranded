<!DOCTYPE html>
<html lang="it">
<head>
    <title><?= htmlspecialchars($pageTitle ?? 'Default Title') ?></title>
    <?php include __DIR__ . '/head.php'; ?>
    <?= $headExtras ?? '' ?>
</head>
<body>
    <?php include $pageContent; ?>
</body>
</html>
