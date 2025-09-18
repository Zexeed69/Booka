<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
  header("Location: ../admin/dashboard.php");
  exit;
}
require_once("../config/db.php");
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Accueil - Booka</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../uploads/ChatGPT Image 11 sept. 2025, 10_43_50.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    .hero { background: url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height:300px; border-radius:1rem; }
    .hero-overlay { background: rgba(0,0,0,.45); border-radius:1rem; }
    .card-img-top { height: 180px; object-fit: cover; }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
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
                <a href="destinations" class="sub-link">Nosy Be</a>
                <a href="destinations" class="sub-link">Antananarivo</a>
                <a href="destinations" class="sub-link">Morondava</a>
                <a href="destinations" class="sub-link">Sainte-Marie</a>
              </div>
              <div class="col">
                <div class="category-title"><i class="bi bi-airplane"></i> Afrique</div>
                <a href="destinations" class="sub-link">Afrique du Sud</a>
                <a href="destinations" class="sub-link">Kenya</a>
                <a href="destinations" class="sub-link">Tanzanie</a>
                <a href="destinations" class="sub-link">Maroc</a>
              </div>
              <div class="col">
                <div class="category-title"><i class="bi bi-globe"></i> Europe</div>
                <a href="destinations" class="sub-link">France</a>
                <a href="destinations" class="sub-link">Italie</a>
                <a href="destinations" class="sub-link">Espagne</a>
                <a href="destinations" class="sub-link">Grèce</a>
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
  <div class="container">
    <div class="hero mb-4 position-relative">
      <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center">
        <div class="container text-white">
          <h1 class="display-6 fw-bold">Trouvez votre prochain séjour</h1>
          <p class="lead">Des offres partout à Madagascar — hôtels, maisons, expériences.</p>
          <form class="row g-2" action="index.php" method="get">
            <div class="col-md-4">
                <input type="text" name="q" class="form-control" placeholder="Nom du produit" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
            </div>
            <div class="col-md-3">
              <input type="date" name="checkin" class="form-control">
            </div>
            <div class="col-md-3">
              <input type="date" name="checkout" class="form-control">
            </div>
            <div class="col-md-2">
              <button class="btn btn-light w-100">Rechercher</button>
              </div>
              <div class="col-md-2">
                <a href="index.php" class="btn btn-secondary w-100">Réinitialiser</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <h3 class="mb-3">Destinations populaires</h3>
    <div class="row">
      <?php
        if (isset($_GET['q']) && trim($_GET['q']) !== '') {
          $q = '%' . $_GET['q'] . '%';
          $stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE name LIKE ? ORDER BY id DESC");
          mysqli_stmt_bind_param($stmt, "s", $q);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
        } else {
          $result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
        }
        while($row = mysqli_fetch_assoc($result)):
      ?>
      <div class="col-sm-6 col-lg-4">
        <div class="card mb-4 shadow-sm h-100">
          <?php if($row['image']): ?>
          <img src="../uploads/<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="image">
          <?php endif; ?>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
            <p class="text-muted mb-1"><?= htmlspecialchars($row['location']) ?></p>
            <p class="card-text small flex-grow-1"><?= nl2br(htmlspecialchars(substr($row['description'],0,120))) ?>...</p>
            <div class="d-flex flex-column align-items-center">
              <div><strong><?= number_format($row['price'],2,',',' ') ?> Ar</strong> / nuit</div>
              <p class="mb-2"><strong>Stock :</strong> <?php echo $row['stock']; ?></p>
              <?php if ($row['stock'] > 0): ?>
                <a href="reservation.php?id=<?= $row['id'] ?>" class="btn btn-primary mx-auto">Réserver</a>
              <?php else: ?>
                <p class="text-danger"><strong>Rupture de stock</strong></p>
                <button class="btn btn-secondary" disabled>Indisponible</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <hr class="my-5">
    <div class="container">
      <h3 class="mb-4 text-center">Offres & Promotions</h3>
      <div id="promoCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="card shadow-sm mx-auto" style="max-width:600px;">
              <div class="card-body text-center">
                <h5 class="card-title">-20% sur les séjours à Nosy Be</h5>
                <p class="card-text">Profitez d'une réduction exceptionnelle pour toute réservation avant le 30 septembre !</p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="card shadow-sm mx-auto" style="max-width:600px;">
              <div class="card-body text-center">
                <h5 class="card-title">Offre Week-end à Andasibe</h5>
                <p class="card-text">2 nuits achetées = 1 nuit offerte pour les familles !</p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="card shadow-sm mx-auto" style="max-width:600px;">
              <div class="card-body text-center">
                <h5 class="card-title">Promo sur les circuits Morondava</h5>
                <p class="card-text">Réservez un circuit et recevez un cadeau surprise !</p>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Suivant</span>
        </button>
      </div>
    </div>
  </div>
  <!-- Section Services -->
  <div class="container mb-5">
    <h3 class="mb-4 text-center">Nos Services</h3>
    <div class="row justify-content-center">
      <div class="col-md-3 mb-3 d-flex align-items-stretch">
        <div class="card h-100 text-center mx-auto" style="max-width: 300px;">
          <div class="card-body">
            <i class="bi bi-headset" style="font-size:2rem;"></i>
            <h5 class="card-title mt-2">Assistance 24/7</h5>
            <p class="card-text">Notre équipe est disponible à tout moment pour répondre à vos questions.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3 d-flex align-items-stretch">
        <div class="card h-100 text-center mx-auto" style="max-width: 300px;">
          <div class="card-body">
            <i class="bi bi-shield-check" style="font-size:2rem;"></i>
            <h5 class="card-title mt-2">Paiement sécurisé</h5>
            <p class="card-text">Vos transactions sont protégées et confidentielles.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3 d-flex align-items-stretch">
        <div class="card h-100 text-center mx-auto" style="max-width: 300px;">
          <div class="card-body">
            <i class="bi bi-star" style="font-size:2rem;"></i>
            <h5 class="card-title mt-2">Sélection de qualité</h5>
            <p class="card-text">Nous proposons uniquement des hébergements et expériences vérifiés.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
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
</script>
<style>
  #scrollProgressBtn {
    position: fixed;
    right: 24px;
    bottom: 32px;
    z-index: 9999;
    width: 54px;
    height: 54px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.13);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: 2px solid #ff6a00;
    transition: background 0.2s;
    opacity: 0.85;
  }
  #scrollProgressBtn:hover { background: #ff6a00; color: #fff; }
  #scrollProgressCircle {
    position: absolute;
    top: 0; left: 0;
    width: 54px; height: 54px;
    pointer-events: none;
  }
  #scrollProgressBtn i { font-size: 1.5rem; z-index: 2; }
</style>
<button id="scrollProgressBtn" title="Remonter" style="display:none;">
  <svg id="scrollProgressCircle" viewBox="0 0 54 54">
    <circle cx="27" cy="27" r="24" fill="none" stroke="#ff6a00" stroke-width="4" stroke-linecap="round" stroke-dasharray="151" stroke-dashoffset="151"/>
  </svg>
  <i class="bi bi-arrow-up"></i>
</button>
<script>
// Jauge de scroll + bouton remonter
const btn = document.getElementById('scrollProgressBtn');
const circle = document.querySelector('#scrollProgressCircle circle');
const dashArray = 151;
window.addEventListener('scroll', () => {
  const scrollTop = window.scrollY || document.documentElement.scrollTop;
  const docHeight = document.documentElement.scrollHeight - window.innerHeight;
  const percent = docHeight > 0 ? Math.min(scrollTop / docHeight, 1) : 0;
  circle.style.strokeDashoffset = dashArray - dashArray * percent;
  btn.style.display = scrollTop > 120 ? 'flex' : 'none';
});
btn.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
<!-- Fin scripts custom -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const spinner = document.getElementById('spinner');
  const reservations = document.querySelector('.row');
  spinner.style.display = 'block';
  reservations.style.opacity = '0.3';
  setTimeout(function() {
    if (spinner) {
      spinner.remove(); // Efface complètement le spinner du DOM
    }
    reservations.style.opacity = '1';
  }, 1000);
});
</script>
</body>
</html>