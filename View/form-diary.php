<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Diary</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="view/css/form.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">
  <div class="form-container bg-white rounded shadow" style="width: 100%; max-width: 700px;">
    
    <div class="form-header bg-secondary text-center text-dark py-2 rounded-top position-relative">
      <a href="index.php?c=Diary&m=list" class="position-absolute start-0 top-50 translate-middle-y ps-3 text-dark text-decoration-none">
        &#x25C0;
      </a>
      <h5 class="m-0 fw-bold">Create Diary</h5>
    </div>

    <form method="POST" enctype="multipart/form-data" action="index.php?c=Diary&m=save" class="p-4">
      
      <div class="mb-3">
        <label class="form-label">Judul:</label>
        <input type="text" name="title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Tanggal:</label>
        <input type="date" name="date" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Pilih Kucing:</label>
        <select name="id_cat" class="form-select" required>
          <option value="">-- Pilih Kucing --</option>
          <?php foreach($cats as $cat): ?>
            <option value="<?= $cat['id_cat'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Isi Diary:</label>
        <textarea name="content" rows="5" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Gambar:</label>
        <input type="file" name="diary_image" class="form-control" required>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

    </form>
  </div>
</body>
</html>
