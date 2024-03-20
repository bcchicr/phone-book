<div class="container">
    <div class="card table-wrap">
        <?php if (isset($students) && count($students) > 0) : ?>
            <table>
                <colgroup>
                    <col class="first-name">
                    <col class="last-name">
                    <col class="group">
                    <col class="points">
                </colgroup>
                <thead>
                    <tr>
                        <th>
                            Имя
                        </th>
                        <th>
                            Фамилия
                        </th>
                        <th>
                            Номер группы
                        </th>
                        <th>
                            Баллы
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) : ?>
                        <tr>
                            <td><?= htmlspecialchars($student->getFirstName()) ?></td>
                            <td><?= htmlspecialchars($student->getLastName()) ?></td>
                            <td><?= htmlspecialchars($student->getGroup()) ?></td>
                            <td><?= htmlspecialchars($student->getExamPoints()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav class="table-nav">
                <p>Страницы: </p>
                <ul>
                    <?php for ($i = 1; $i < count($students); $i++) : ?>
                        <li><?= $i ?></li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php else : ?>
            <p>Пока не зарегистрировано ни одного студента.</p>
        <?php endif; ?>
    </div>
</div>