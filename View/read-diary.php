<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= $diary['title'] ?> - Cat Diary</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="view/css/read.css" rel="stylesheet">
</head>
<body class="bg-white d-flex justify-content-center">

<div class="container p-4 shadow rounded-4" style="max-width: 600px; background-color: #fff;">
  <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
    <a href="index.php?c=Diary&m=list" class="btn btn-link text-decoration-none">&larr;</a>
    <h4 class="m-0 text-center flex-grow-1 fw-semibold"><?= htmlspecialchars($diary['title']) ?></h4>
    <a href="index.php?c=Diary&m=delete&id=<?= $diary['id_diary'] ?>" onclick="return confirm('Hapus diary ini?')" class="btn btn-link text-danger fs-5">🗑</a>
  </div>

  <p><strong>Kucing:</strong> <?= htmlspecialchars($diary['cat_name']) ?></p>
  <p><strong>Tanggal:</strong> <?= $diary['date'] ?></p>
  <p><?= nl2br(htmlspecialchars($diary['content'])) ?></p>

  <?php if (!empty($diary['diary_image'])): ?>
    <div class="mt-3 text-center">
      <img src="uploads/<?= htmlspecialchars($diary['diary_image']) ?>" class="img-fluid rounded" style="max-height: 300px;" alt="Diary Image">
    </div>
  <?php endif; ?>
</div>

</body>
</html>
