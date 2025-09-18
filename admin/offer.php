<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: ../auth/login.php"); exit;
}
require_once("../config/db.php");
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Liste des offres - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
<main class="container py-5">
    <div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Offres</h3>
    <a class="btn btn-primary" href="add_offer.php">Ajouter une offre</a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle table-bordered">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Titre</th>
          <th>Description</th>
          <th>Prix</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php $result = mysqli_query($conn, "SELECT * FROM offers ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?php if($row['image']): ?><img src="../uploads/<?= htmlspecialchars($row['image']) ?>" width="80"><?php endif; ?></td>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= htmlspecialchars(mb_strimwidth(strip_tags($row['description']),0,60,'...')) ?></td>
          <td><?= number_format($row['price'],2,',',' ') ?> Ar</td>
          <td><?= htmlspecialchars($row['created_at']) ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</main>
<footer class="border-top py-4 text-center small text-muted bg-white fixed-bottom">
  © <?php echo date('Y'); ?> Booka — Mini projet style Booking.com
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
