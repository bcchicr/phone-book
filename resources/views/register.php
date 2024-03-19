<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://kit.fontawesome.com/14de4b1c37.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="main-container">
        <?php include __DIR__ . '/components/header.php' ?>
        <main>
            <div class="container">

                <form class="card" action="/register" method="post">
                    <h2 class="form-header">Регистрация</h2>
                    <fieldset>
                        <input class="field" name="login" type="text" placeholder="Логин" required>
                        <input class="field" name="email" type="email" placeholder="E-mail" required>
                        <input class="field" name=" password" type="password" placeholder=" Пароль" required>
                        <input class="field" name=" password" type="password" placeholder=" Пароль еще раз" required>
                    </fieldset>
                    <div class="form-divider"></div>
                    <fieldset>
                        <input class="field" name="first-name" type="text" placeholder="Имя" required>
                        <input class="field" name="last-name" type="text" placeholder="Фамилия" required>
                        <label class="field-label" for="sex">Пол:</label>
                        <select class="field" id="sex" name="sex" required>
                            <option value="" disabled selected> --- </option>
                            <option value="m">Мужской</option>
                            <option value="f">Женский</option>
                        </select>
                        <label class="field-label" for="birth-date">Дата рождения:</label>
                        <input class="field" id="birth-date" type="date" name="birth-date" required>
                        <input class="field" name="points" type="number" placeholder="Баллы ЕГЭ" required>
                        <input class="field" name="group" type="text" placeholder="Группа" required>
                    </fieldset>
                    <button class="submit" type="submit">Зарегистрироваться</button>

                </form>
            </div>
        </main>
        <?php include __DIR__ . '/components/footer.php' ?>
    </div>
</body>

</html>