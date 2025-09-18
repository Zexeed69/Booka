<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Maj statut</title>
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
?>\n
<?php require_once("../config/db.php");
if($_SERVER['REQUEST_METHOD']==='POST'){
  $id=(int)$_POST['id']; $status=$_POST['status'];
  if(in_array($status,['pending','confirmed','cancelled'])){
    $stmt=mysqli_prepare($conn,"UPDATE reservations SET status=? WHERE id=?");
    mysqli_stmt_bind_param($stmt,"si",$status,$id); mysqli_stmt_execute($stmt);
  }
}
header("Location: reservations.php"); exit;?>
</main>
<footer class="border-top py-4 text-center small text-muted">
  © <?php echo date('Y'); ?> Booka — Mini projet style Booking.com
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
