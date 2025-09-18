<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: ../auth/login.php"); exit;
}
require_once("../config/db.php");
$err = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title']);
  $description = trim($_POST['description']);
  $price = floatval($_POST['price']);
  $filename = null;
  if (!empty($_FILES['image']['name'])) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = time().'_'.bin2hex(random_bytes(4)).'.'.$ext;
    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/../uploads/'.$filename);
  }
  $stmt = mysqli_prepare($conn, "INSERT INTO offers (title, description, price, image) VALUES (?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "ssds", $title, $description, $price, $filename);
  if (mysqli_stmt_execute($stmt)) {
    header("Location: ../public/offres.php?added=1"); exit;
  } else {
    $err = "Erreur lors de l'ajout de l'offre.";
  }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajouter une offre - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.php">Booka Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="../public/offres.php">Voir les offres</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>
      </ul>
    </div>
  </div>
</nav>
<main class="container py-5">
  <h2 class="mb-4">Ajouter une offre</h2>
  <?php if($err): ?><div class="alert alert-danger"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Titre de l'offre</label>
      <input name="title" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Prix (Ar)</label>
      <input name="price" type="number" step="0.01" class="form-control" required>
    </div>
    <div class="col-12">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4" required></textarea>
    </div>
    <div class="col-12">
      <label class="form-label">Image</label>
      <input type="file" name="image" accept="image/*" class="form-control">
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Ajouter l'offre</button>
    </div>
  </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
