<div>
  <a class="fs-5 link-offset-1 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="/records/create">Добавить запись</a>
</div>
<div class="border border-3 border-primary-subtle rounded-3 bg-body mb-3 p-4">
  <?php if (isset($records) && count($records) > 0) : ?>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Имя</th>
          <th scope="col">Фамилия</th>
          <th scope="col">Телефон</th>
          <th scope="col">Управление</th>
        </tr>
      </thead>
      <tbody>
        <?php for ($i = 0; $i < count($records); $i++) : ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($records[$i]->firstName) ?></td>
            <td><?= htmlspecialchars($records[$i]->lastName) ?></td>
            <td><?= htmlspecialchars($records[$i]->phoneNumber) ?></td>
            <td>
              <form action="/records/delete?id=<?= $i ?>" method="post">
                <button type="submit">
                  Удалить
                </button>
              </form>
            </td>
          </tr>
        <?php endfor; ?>
      </tbody>
    </table>
  <?php else : ?>
    <p>Пока в телефонной книге не зарегистрировано ни одной записи.</p>
  <?php endif; ?>
</div>