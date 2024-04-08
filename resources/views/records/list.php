<?php if (isset($records) && count($records) > 0) : ?>
  <div class="border border-3 border-primary-subtle rounded-3 bg-body p-4">

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Имя</th>
          <th scope="col">Фамилия</th>
          <th scope="col">Телефон</th>
          <th scope="col">Управление</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 0 ?>
        <?php for ($i = 0; $i < count($records); $i++) : ?>
          <tr>
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