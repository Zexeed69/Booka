<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Dashboard</title>
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
    <a class="navbar-brand fw-bold" href="dashboard.php">Booka</a>
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
<?php require_once("../config/db.php"); ?>
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Tableau de bord</h3>
    <a class="btn btn-outline-primary" href="../public/index.php">Voir le site</a>
  </div>
  <div class="row g-3">
    <div class="col-md-4">
      <div class="card"><div class="card-body">
        <h5 class="card-title">Produits</h5>
        <?php $c = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM products"))['c']; ?>
        <p class="display-6"><?= (int)$c ?></p>
        <a href="products.php" class="btn btn-primary">Gérer</a>
      </div></div>
    </div>
    <div class="col-md-4">
      <div class="card"><div class="card-body">
        <h5 class="card-title">Offres</h5>
        <?php $c4 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM offers"))['c']; ?>
        <p class="display-6"><?= (int)$c4 ?></p>
        <a href="offer.php" class="btn btn-primary">Gérer</a>
      </div></div>
    </div>
    <div class="col-md-4">
      <div class="card"><div class="card-body">
        <h5 class="card-title">Réservations</h5>
        <?php $c2 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM reservations"))['c']; ?>
        <p class="display-6"><?= (int)$c2 ?></p>
        <a href="reservations.php" class="btn btn-primary">Voir</a>
      </div></div>  
    </div>
    <div class="col-md-4">
      <div class="card"><div class="card-body">
        <h5 class="card-title">Utilisateurs</h5>
        <?php $c3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM users"))['c']; ?>
        <p class="display-6"><?= (int)$c3 ?></p>
      </div></div>
    </div>
  </div>
</div>
</main>
<footer class="border-top py-4 text-center small text-muted bg-white fixed-bottom">
  © <?php echo date('Y'); ?> Booka — Mini projet style Booking.com
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
