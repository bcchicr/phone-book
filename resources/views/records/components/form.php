<?php session_start(); ?>
<div>
  <a class="fs-5 link-offset-1 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="/">На главную</a>
</div>
<div class="border border-3 border-primary-subtle rounded-3 bg-body mb-3 p-4">
  <h2 class="text-center">Добавить запись</h2>
  <form class="" action="/records/store" method="POST">
    <div class="col-10 offset-1 col-md-6 offset-md-3">
      <div class="mb-3">
        <label for="first-name-field" class="form-label">Имя:</label>
        <input class="form-control" id="first-name-field" name="first-name" type="text" required>
        <?php if (isset($_SESSION['errors']['first-name'])) : ?>
          <p class="text-danger"><?= $_SESSION['errors']['first-name'][0] ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="last-name-field" class="form-label">Фамилия:</label>
        <input class="form-control" id="last-name-field" name="last-name" type="text" required>
        <?php if (isset($_SESSION['errors']['last-name'])) : ?>
          <p class="text-danger"><?= $_SESSION['errors']['last-name'][0] ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="phone-number-field" class="form-label">Телефон:</label>
        <input class="form-control" id="phone-number-field" name="phone-number" type="text" required>
        <?php if (isset($_SESSION['errors']['phone-number'])) : ?>
          <p class="text-danger"><?= $_SESSION['errors']['phone-number'][0] ?></p>
        <?php endif; ?>
      </div>
      <button class="d-block w-75 mx-auto btn btn-primary btn-lg" type="submit">Добавить</button>
    </div>
  </form>
</div>
<?php session_destroy(); ?>