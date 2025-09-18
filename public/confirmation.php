<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once("../config/db.php");
if (empty($_SESSION['user'])) {
  header("Location: ../auth/login.php");
  exit;
}
$user_id = $_SESSION['user']['id'];
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mes réservations - Booka</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    .navbar-alibaba {
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
    .navbar-alibaba .nav-link, .navbar-alibaba .navbar-brand {
      color: #333 !important;
      font-weight: 500;
    }
    .navbar-alibaba .nav-link:hover, .navbar-alibaba .dropdown-item:hover {
      color: #ff6a00 !important;
      background: none;
    }
    .mega-menu {
      left: 0;
      right: 0;
      width: 100vw;
      top: 100%;
      position: absolute;
      background: #fff;
      box-shadow: 0 4px 24px rgba(0,0,0,0.09);
      z-index: 999;
      padding: 2rem 3vw;
      display: none;
    }
    .dropdown:hover .mega-menu, .dropdown:focus .mega-menu {
      display: block;
    }
    .mega-menu .col {
      min-width: 180px;
    }
    .mega-menu .category-title {
      font-weight: 600;
      color: #333;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .mega-menu .sub-link {
      color: #555;
      text-decoration: none;
      display: block;
      margin-bottom: 0.3rem;
      transition: color 0.2s;
      padding: 2px 0;
    }
    .mega-menu .sub-link:hover {
      color: #ff6a00;
      background: none;
    }
    @media (max-width: 991px) {
      .mega-menu {
        position: static;
        box-shadow: none;
        padding: 1rem 0;
      }
    }
    /* ...autres styles existants... */
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
        <li class="nav-item dropdown position-static">
          <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-grid-3x3-gap-fill me-1"></i> Destinations
          </a>
          <div class="mega-menu dropdown-menu border-0 rounded-0 mt-0" aria-labelledby="categoriesDropdown">
            <div class="row g-4">
              <div class="col">
                <div class="category-title"><i class="bi bi-geo-alt"></i> Madagascar</div>
                <a href="#" class="sub-link">Nosy Be</a>
                <a href="#" class="sub-link">Antananarivo</a>
                <a href="#" class="sub-link">Morondava</a>
                <a href="#" class="sub-link">Sainte-Marie</a>
              </div>
              <div class="col">
                <div class="category-title"><i class="bi bi-airplane"></i> Afrique</div>
                <a href="#" class="sub-link">Afrique du Sud</a>
                <a href="#" class="sub-link">Kenya</a>
                <a href="#" class="sub-link">Tanzanie</a>
                <a href="#" class="sub-link">Maroc</a>
              </div>
              <div class="col">
                <div class="category-title"><i class="bi bi-globe"></i> Europe</div>
                <a href="#" class="sub-link">France</a>
                <a href="#" class="sub-link">Italie</a>
                <a href="#" class="sub-link">Espagne</a>
                <a href="#" class="sub-link">Grèce</a>
              </div>
              <div class="col">
                <div class="category-title"><i class="bi bi-sun"></i> Séjours & Circuits</div>
                <a href="#" class="sub-link">Séjours balnéaires</a>
                <a href="#" class="sub-link">Circuits aventure</a>
                <a href="#" class="sub-link">Voyages de noces</a>
                <a href="#" class="sub-link">Famille</a>
              </div>
              <div class="col">
                <div class="category-title"><i class="bi bi-star"></i> Services</div>
                <a href="#" class="sub-link">Assistance Visa</a>
                <a href="#" class="sub-link">Location voiture</a>
                <a href="#" class="sub-link">Guides locaux</a>
                <a href="#" class="sub-link">Assurance voyage</a>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item"><a href="index.php" class="nav-link">Accueil</a></li>
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
<main class="py-4">
  <div class="container" style="max-width:900px;">
    <h3 class="mb-4">Mes réservations</h3>
    <?php
    $q = "SELECT r.*, p.name AS product_name, p.location FROM reservations r JOIN products p ON r.product_id = p.id WHERE r.user_id = ? ORDER BY r.id DESC";
    $stmt = mysqli_prepare($conn, $q);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($res) > 0) {
      echo '<div class="table-responsive"><table class="table table-bordered align-middle"><thead><tr><th>Hébergement</th><th>Lieu</th><th>Check-in</th><th>Check-out</th><th>Voyageurs</th><th>Status</th></tr></thead><tbody>';
      while ($row = mysqli_fetch_assoc($res)) {
        $status = $row['status'];
        $badge = '';
        if ($status === 'pending') {
          $badge = '<span class="badge bg-warning text-dark">En attente</span>';
        } elseif ($status === 'confirmed') {
          $badge = '<span class="badge bg-success">Confirmée</span>';
        } elseif ($status === 'cancelled') {
          $badge = '<span class="badge bg-danger">Annulée</span>';
        } else {
          $badge = htmlspecialchars($status);
        }
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['location']) . '</td>';
        echo '<td>' . htmlspecialchars($row['checkin']) . '</td>';
        echo '<td>' . htmlspecialchars($row['checkout']) . '</td>';
        echo '<td>' . (int)$row['guests'] . '</td>';
        echo '<td>' . $badge . '</td>';
        echo '</tr>';
      }
      echo '</tbody></table></div>';
    } else {
      echo '<div class="alert alert-danger">Aucune réservation trouvée pour votre compte.</div>';
    }
    ?>
  </div>
</main>
<style>
  body, html { height: 100%; }
  body { min-height: 100vh; display: flex; flex-direction: column; }
  main { flex: 1 0 auto; }
</style>
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
