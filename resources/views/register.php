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
                        <input class="field" name="login" type="text" placeholder="Логин" value="<?= $values['login'] ?>" required>
                        <div class="hint-container">
                            <?php if (isset($errors['login'])) : ?>
                                <?php foreach ($errors['login'] as $error) : ?>
                                    <small class="hint error"><?= htmlspecialchars($error) ?></small>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <input class="field" name="email" type="email" placeholder="E-mail" value="<?= $values['email'] ?>" required>
                        <div class=" hint-container">
                            <?php if (isset($errors['email'])) : ?>
                                <?php foreach ($errors['email'] as $error) : ?>
                                    <small class="hint error"><?= htmlspecialchars($error) ?></small>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <input class="field" name=" password" type="password" placeholder=" Пароль" value="<?= $values['password'] ?>" required>
                        <div class="hint-container">
                            <?php if (isset($errors['password'])) : ?>
                                <?php foreach ($errors['password'] as $error) : ?>
                                    <small class="hint error"><?= htmlspecialchars($error) ?></small>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                    <div class="form-divider"></div>
                    <fieldset>
                        <input class="field" name="first-name" type="text" placeholder="Имя" value="<?= $values['first-name'] ?>" required>
                        <div class="hint-container">
                            <?php if (isset($errors['first-name'])) : ?>
                                <small class="hint">Буквы русского алфавита, дефис, апостроф или пробел.</small>
                                <?php foreach ($errors['first-name'] as $error) : ?>
                                    <small class="hint error"><?= htmlspecialchars($error) ?></small>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <input class="field" name="last-name" type="text" placeholder="Фамилия" value="<?= $values['last-name'] ?>" required>
                        <div class="hint-container">
                            <?php if (isset($errors['last-name'])) : ?>
                                <small class="hint">Буквы русского алфавита, дефис, апостроф или пробел.</small>
                                <?php foreach ($errors['last-name'] as $error) : ?>
                                    <small class="hint error"><?= htmlspecialchars($error) ?></small>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <label class="field-label" for="sex">Пол:</label>
                        <select class="field" id="sex" name="sex" value="<?= $values['sex'] ?>" required>
                            <option value="m">Мужской</option>
                            <option value="f">Женский</option>
                        </select>
                        <div class="hint-container">
                            <?php if (isset($errors['sex'])) : ?>
                                <?php foreach ($errors['sex'] as $error) : ?>
                                    <small class="hint error"><?= htmlspecialchars($error) ?></small>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <label class="field-label" for="birth-date">Дата рождения:</label>
                        <input class="field" id="birth-date" type="date" name="birth-date" value="<?= $values['birth-date'] ?>" required>
                        <div class="hint-container">
                            <?php if (isset($errors['birth-date'])) : ?>
                                <?php foreach ($errors['birth-date'] as $error) : ?>
                                    <small class="hint error"><?= htmlspecialchars($error) ?></small>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <input class="field" name="points" type="number" placeholder="Баллы ЕГЭ" value="<?= $values['points'] ?>" required>
                        <div class="hint-container">
                            <?php if (isset($errors['points'])) : ?>
                                <?php foreach ($errors['points'] as $error) : ?>
                                    <small class="hint error"><?= htmlspecialchars($error) ?></small>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <input class="field" name="group" type="text" placeholder="Группа" value="<?= $values['group'] ?>" required>
                        <div class="hint-container">
                            <?php if (isset($errors['group'])) : ?>
                                <small class="hint">От 2 до 5 русских букв или цифр.</small>
                                <?php foreach ($errors['group'] as $error) : ?>
                                    <small class="hint error"><?= htmlspecialchars($error) ?></small>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                    <button class="submit" type="submit">Зарегистрироваться</button>
                </form>
            </div>
        </main>
        <?php include __DIR__ . '/components/footer.php' ?>
    </div>
</body>

</html>