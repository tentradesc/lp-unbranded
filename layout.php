<!DOCTYPE html>
<html lang="it">x
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?? 'Default Title' ?></title>
    <?php include __DIR__ . '/head.php'; ?>
</head>
<body>
    <?php include $pageContent; ?>
</body>
</html>
