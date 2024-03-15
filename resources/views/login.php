<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>

<body>
    <?php include __DIR__ . '/components/header.php' ?>
    <main>
        <form action="/login" method="post">
            <div>
                <label>Логин или e-mail: <br>
                    <input type="text" name="user-id" required>
                </label>
            </div>
            <div>
                <label>Пароль: <br>
                    <input type="password" name="password" required>
                </label>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </main>
    <?php include __DIR__ . '/components/footer.php' ?>
</body>

</html>