<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>List Diary</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="view/css/list.css" rel="stylesheet" />
</head>
<body class="bg-white d-flex flex-column justify-content-center">
<?php require_once "navbar.php"?>
<div class="container p-0 shadow rounded-4 overflow-hidden" style="max-width: 700px;">
  <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom bg-white">
    <h3 class="m-0 text-center flex-grow-1 fw-bold">DIARY</h3>
    <a href="index.php?c=Diary&m=form" class="text-dark">
      <svg width="28" height="28" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M23.75 3.75H6.25C4.869 3.75 3.75 4.869 3.75 6.25V23.75C3.75 25.131 4.869 26.25 6.25 26.25H23.75C25.131 26.25 26.25 25.131 26.25 23.75V6.25C26.25 4.869 25.131 3.75 23.75 3.75Z" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M15 10V20" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M10 15H20" stroke="#191919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </a>
  </div>

  <div class="p-3 bg-white">
    <?php 
    $current_month = '';
    foreach ($diaries as $diary):
      $month = date('F, Y', strtotime($diary['date']));
      if ($month != $current_month):
        $current_month = $month;
    ?>
      <div class="bg-secondary-subtle text-dark fw-semibold px-2 py-1 rounded mb-2"><?= $current_month ?></div>
    <?php endif; ?>
      <div class="d-flex align-items-center bg-light rounded p-3 mb-2">
        <div class="flex-grow-1">
          <a href="index.php?c=Diary&m=read&id=<?= $diary['id_diary'] ?>" class="text-decoration-none text-dark">
            <h5 class="fw-bold mb-1"><?= htmlspecialchars($diary['title']) ?></h5>
            <p class="mb-1 text-secondary small"><?= substr(htmlspecialchars($diary['content']), 0, 100) ?>...</p>
            <small class="text-muted"><?= htmlspecialchars($diary['cat_name']) ?> - <?= $diary['date'] ?></small>
          </a>
        </div>
        <div class="ms-3">
          <div class="rounded bg-secondary-subtle" style="width: 60px; height: 50px;"></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
