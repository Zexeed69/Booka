<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Ajouter produit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .hero { background: url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height:300px; border-radius:1rem; }
    .hero-overlay { background: rgba(0,0,0,.45); border-radius:1rem; }
    .card-img-top { height: 180px; object-fit: cover; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/public/index.php">Booka</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Accueil</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if(empty($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="../auth/login.php">Connexion</a></li>
          <li class="nav-item"><a class="nav-link" href="../auth/register.php">Créer un compte</a></li>
        <?php else: ?>
          <li class="nav-item"><span class="navbar-text text-white me-2">Bonjour, <?= htmlspecialchars($_SESSION['user']['username']) ?></span></li>
          <li class="nav-item"><a class="btn btn-light btn-sm" href="../auth/logout.php">Déconnexion</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<main class="py-4"><?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: ../auth/login.php"); exit;
}
?>
<?php require_once("../config/db.php"); $err="";
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name = trim($_POST['name']); $location = trim($_POST['location']);
  $price = floatval($_POST['price']); $description = trim($_POST['description']);
  $filename = null;
  if (!empty($_FILES['image']['name'])) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = time().'_'.bin2hex(random_bytes(4)).'.'.$ext;
    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/../uploads/'.$filename);
  }
  $stmt = mysqli_prepare($conn,"INSERT INTO products (name,description,location,price,image,stock) VALUES (?,?,?,?,?,?)");
  mysqli_stmt_bind_param($stmt,"sssdsd",$name,$description,$location,$price,$filename,$_POST['stock']);
  if(mysqli_stmt_execute($stmt)){
    header("Location: ../public/index.php?added=1");
    exit;
  } else {
    $err="Erreur lors de l'ajout.";
  }
} ?>
<div class="container" style="max-width:820px;">
  <h3 class="mb-3">Ajouter un produit</h3>
  <?php if(!empty($err)): ?><div class="alert alert-danger"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="row g-3">
      <div class="col-md-6"><label class="form-label">Nom</label><input name="name" class="form-control" required></div>
      <div class="col-md-6"><label class="form-label">Lieu</label><input name="location" class="form-control" required></div>
      <div class="col-md-6"><label class="form-label">Prix (Ar)</label><input type="number" step="0.01" name="price" class="form-control" required></div>
      <div class="mb-3"><label for="stock" class="form-label">Stock</label><input type="number" class="form-control" id="stock" name="stock" required></div>
      <div class="col-md-6"><label class="form-label">Image</label><input type="file" name="image" class="form-control"></div>
      <div class="col-12"><label class="form-label">Description</label><textarea name="description" rows="5" class="form-control"></textarea></div>
    </div>
    <button class="btn btn-primary mt-3">Enregistrer</button>
    <a href="/admin/products.php" class="btn btn-outline-secondary mt-3">Annuler</a>
  </form>
</div>
</main>
<footer class="border-top py-4 text-center small text-muted">
  © <?php echo date('Y'); ?> Booka — Mini projet style Booking.com
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
