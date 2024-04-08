<!DOCTYPE html>
<html lang="ru" class="h-100" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Список абитуриентов</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/14de4b1c37.js" crossorigin="anonymous"></script>
</head>

<body class="d-flex flex-column h-100 bg-body-tertiary">
  <?php include __DIR__ . '/../components/header.php' ?>
  <main class="flex-shrink-0">
    <div class="container mt-3">
      <div class="row">
        <div class="col-10 offset-1 col-md-8 offset-md-2">
          <?php include __DIR__ . '/components/list.php' ?>
        </div>
      </div>
    </div>
  </main>
  <?php include __DIR__ . '/../components/footer.php' ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>