<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once("../config/db.php");
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Destinations Madagascar - Booka Voyages</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    .navbar-alibaba { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
    .navbar-alibaba .nav-link, .navbar-alibaba .navbar-brand { color: #333 !important; font-weight: 500; }
    .navbar-alibaba .nav-link:hover, .navbar-alibaba .dropdown-item:hover { color: #ff6a00 !important; background: none; }
    .destination-card { box-shadow: 0 2px 12px rgba(0,0,0,0.08); transition: transform 0.2s, box-shadow 0.2s; border: none; }
    .destination-card:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 8px 24px rgba(255,106,0,0.13); border: 1px solid #ff6a0022; }
    .destination-img { height: 180px; object-fit: cover; border-radius: 0.5rem 0.5rem 0 0; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-alibaba py-2">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="../uploads/ChatGPT Image 11 sept. 2025, 10_43_50.png" alt="Logo" width="40" class="me-2">
      Booka Voyages
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="destinations.php">Destinations</a></li>
        <li class="nav-item"><a class="nav-link" href="offres.php">Offres</a></li>
        <li class="nav-item"><a class="nav-link" href="#services">Nos Services</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
      </ul>
      <ul class="navbar-nav ms-lg-3 align-items-lg-center">
        <?php if(empty($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="../auth/login.php">Connexion</a></li>
          <li class="nav-item"><a class="nav-link" href="../auth/register.php">Créer un compte</a></li>
        <?php else: ?>
          <li class="nav-item"><span class="navbar-text text-dark me-2">Bonjour, <?= htmlspecialchars($_SESSION['user']['username']) ?></span></li>
          <li class="nav-item"><a class="btn btn-outline-warning btn-sm" href="../auth/logout.php">Déconnexion</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<main class="py-5">
  <div class="container">
    <h2 class="mb-4 text-center">Destinations à Madagascar</h2>
    <div class="row g-4">
      <?php 
      $result = mysqli_query($conn, "SELECT * FROM products WHERE location LIKE '%madagascar%' ORDER BY id DESC");
      if(mysqli_num_rows($result) > 0):
        while($row = mysqli_fetch_assoc($result)):
      ?>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card destination-card">
          <?php if($row['image']): ?>
            <img src="../uploads/<?= htmlspecialchars($row['image']) ?>" class="destination-img card-img-top" alt="<?= htmlspecialchars($row['name']) ?>">
          <?php else: ?>
            <img src="https://via.placeholder.com/600x180?text=Destination" class="destination-img card-img-top" alt="Image par défaut">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
            <a href="destination-details.php?id=<?= $row['id'] ?>" class="btn btn-primary">Voir plus</a>
          </div>
        </div>
      </div>
      <?php endwhile; else: ?>
        <div class="col-12"><div class="alert alert-warning text-center">Aucune destination trouvée à Madagascar.</div></div>
      <?php endif; ?>
    </div>
  </div>
</main>
<style>
  body, html { height: 100%; }
  body { min-height: 100vh; display: flex; flex-direction: column; }
  main { flex: 1 0 auto; }
</style>
<footer class="border-top py-4 text-center small text-muted bg-white mt-auto">
  <div class="container">
    <div class="row text-start">
      <div class="col-md-4 mb-3">
        <h6 class="fw-bold">Assistance</h6>
        <ul class="list-unstyled">
          <li><a href="faq.php" class="text-decoration-none text-muted">FAQ</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Contact</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Support technique</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-3">
        <h6 class="fw-bold">Politiques</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-muted">Confidentialité</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Conditions d'utilisation</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Remboursement</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-3">
        <h6 class="fw-bold">À propos</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-muted">Notre équipe</a></li>
          <li><a href="#" class="text-decoration-none text-muted">À propos de Booka</a></li>
          <li><a href="#" class="text-decoration-none text-muted">Carrières</a></li>
        </ul>
      </div>
    </div>
    <div class="text-center mt-3">
      © <?php echo date('Y'); ?> Booka — Mini projet style Booking.com
    </div>
  </div>
</footer>
<!-- Section Footer -->
<footer class="border-top py-4 text-muted bg-white" style="position:relative;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-4 mb-3 text-center text-md-start">
        <h6 class="fw-bold mb-2">Contactez-nous</h6>
        <p class="mb-1"><i class="bi bi-envelope"></i> contact@booka-voyages.com</p>
        <p class="mb-1"><i class="bi bi-telephone"></i> +261 34 12 345 67</p>
        <p class="mb-0"><i class="bi bi-geo-alt"></i> Antananarivo, Madagascar</p>
      </div>
      <div class="col-md-4 mb-3 text-center">
        <h6 class="fw-bold mb-2">Suivez-nous</h6>
        <a href="#" class="text-muted me-2 fs-5"><i class="bi bi-facebook"></i></a>
        <a href="#" class="text-muted me-2 fs-5"><i class="bi bi-instagram"></i></a>
        <a href="#" class="text-muted me-2 fs-5"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="text-muted fs-5"><i class="bi bi-youtube"></i></a>
        <div class="mt-2 small">Partagez vos souvenirs avec <span class="fw-bold text-primary">#BookaVoyages</span> !</div>
      </div>
      <div class="col-md-4 mb-3 text-center text-md-end">
        <h6 class="fw-bold mb-2">À propos de Booka</h6>
        <p class="mb-1">Booka, c'est une équipe passionnée qui vous accompagne dans la création de vos plus beaux voyages.</p>
        <p class="mb-0">Merci de faire confiance à notre petite agence humaine et locale !</p>
      </div>
    </div>
    <div class="text-center mt-3 small">
      <span>© <?php echo date('Y'); ?> Booka. Tous droits réservés.</span>
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
