<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>

<body>
    <?php include __DIR__ . '/components/header.php' ?>
    <main>
        <form action="/register" method="post">
            <fieldset>
                <div>
                    <label>Логин: <br>
                        <input type="text" name="login" required>
                    </label>
                </div>
                <div>
                    <label>E-mail: <br>
                        <input type="email" name="email" required>
                    </label>
                </div>
                <div>
                    <label>Пароль: <br>
                        <input type="password" name="password" required>
                    </label>
                </div>



            </fieldset>
            <fieldset>
                <div>
                    <label>Имя: <br>
                        <input type="text" name="first-name" required>
                    </label>
                </div>
                <div>
                    <label>Фамилия: <br>
                        <input type="text" name="last-name" required>
                    </label>
                </div>
                <div>
                    <label>Пол: <br>
                        <select name="sex" required>
                            <option disabled selected> --- </option>
                            <option value="m">Мужской</option>
                            <option value="f">Женский</option>
                        </select>
                    </label>
                </div>
                <div>
                    <label> Дата рождения: <br>
                        <input type="date" name="birth-date" required>
                    </label>
                </div>
                <div>
                    <label> Баллы ЕГЭ: <br>
                        <input type="number" name="points" required>
                    </label>
                </div>
                <div>
                    <label>Группа: <br>
                        <input type="text" name="group" required>
                    </label>
                </div>






            </fieldset>
            <input type="submit">
        </form>
    </main>
    <?php include __DIR__ . '/components/footer.php' ?>
</body>

</html>