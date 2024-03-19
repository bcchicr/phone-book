<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://kit.fontawesome.com/14de4b1c37.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="main-container">
        <?php include __DIR__ . '/components/header.php' ?>
        <main>
            <div class="container">
                <form class="card" action="/login" method="post">
                    <h2 class="form-header">Вход</h2>
                    <fieldset>
                        <input class="field" name="user-id" type="text" placeholder="Логин или e-mail" required>
                        <input class="field" name="password" type="password" placeholder="Пароль" required>
                    </fieldset>
                    <button class="submit" type="submit">Войти</button>
                </form>
            </div>
        </main>
        <?php include __DIR__ . '/components/footer.php' ?>
    </div>
</body>

</html>