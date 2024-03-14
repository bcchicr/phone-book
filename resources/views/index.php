<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Page</title>
</head>

<body>
    <h1>START PAGE</h1>
    <?php if (isset($test)) : ?>
        <p><?= $test ?></p>
    <?php endif; ?>
</body>

</html>