
<?php include 'config/config.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Language Website</title>
</head>
<body>
    <h2><?php echo $translations['welcome']; ?></h2>
    <p><?php echo $translations['choose_language']; ?>:</p>
    <a href="set_language.php?lang=en">English</a> | 
    <a href="set_language.php?lang=es">Español</a>
    <p><?php echo $translations['hello']; ?>!</p>
</body>
</html>
    