<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nos Offres - Booka Voyages</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    .navbar-alibaba { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
    .navbar-alibaba .nav-link, .navbar-alibaba .navbar-brand { color: #333 !important; font-weight: 500; }
    .navbar-alibaba .nav-link:hover, .navbar-alibaba .dropdown-item:hover { color: #ff6a00 !important; background: none; }
    .carousel-offre-img { height: 380px; object-fit: cover; border-radius: 1rem; }
    .offre-card { box-shadow: 0 2px 12px rgba(0,0,0,0.08); border: none; transition: box-shadow 0.2s, transform 0.2s; }
    .offre-card:hover { box-shadow: 0 8px 24px rgba(255,106,0,0.13); transform: translateY(-4px) scale(1.01); border: 1px solid #ff6a0022; }
    .divider { border: 0; border-top: 2px solid #eee; margin: 2.5rem 0; }
    .offre-img { height: 220px; object-fit: cover; border-radius: 0.75rem 0.75rem 0 0; }
    @media (max-width: 767px) { .carousel-offre-img { height: 200px; } .offre-img { height: 140px; } }
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
                <a href="madagascar.php" class="sub-link">Nosy Be</a>
                <a href="madagascar.php" class="sub-link">Antananarivo</a>
                <a href="madagascar.php" class="sub-link">Morondava</a>
                <a href="madagascar.php" class="sub-link">Sainte-Marie</a>
              </div>
              <div class="col">
                <div class="category-title"><i class="bi bi-airplane"></i> Afrique</div>
                <a href="afrique.php" class="sub-link">Afrique du Sud</a>
                <a href="afrique.php" class="sub-link">Kenya</a>
                <a href="afrique.php" class="sub-link">Tanzanie</a>
                <a href="afrique.php" class="sub-link">Maroc</a>
              </div>
              <div class="col">
                <div class="category-title"><i class="bi bi-globe"></i> Europe</div>
                <a href="europe.php" class="sub-link">France</a>
                <a href="europe.php" class="sub-link">Italie</a>
                <a href="europe.php" class="sub-link">Espagne</a>
                <a href="europe.php" class="sub-link">Grèce</a>
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
<?php require_once("../config/db.php"); ?>
<main class="py-5">
  <div class="container">
    <?php 
    $result = mysqli_query($conn, "SELECT * FROM offers ORDER BY id DESC");
    $offers = [];
    while($row = mysqli_fetch_assoc($result)) $offers[] = $row;
    ?>
    <?php if(count($offers) > 0): ?>
      <!-- Carrousel d'offres dynamiques -->
      <div id="offresCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner rounded-4">
          <?php foreach($offers as $i => $offre): ?>
          <div class="carousel-item<?= $i === 0 ? ' active' : '' ?>">
            <div class="row align-items-center g-4">
              <div class="col-md-6">
                <?php if($offre['image']): ?>
                  <img src="../uploads/<?= htmlspecialchars($offre['image']) ?>" class="w-100 carousel-offre-img" alt="<?= htmlspecialchars($offre['title']) ?>">
                <?php else: ?>
                  <img src="https://via.placeholder.com/800x380?text=Offre" class="w-100 carousel-offre-img" alt="Image par défaut">
                <?php endif; ?>
              </div>
              <div class="col-md-6">
                <h2 class="mb-3"><?= htmlspecialchars($offre['title']) ?></h2>
                <p><?= nl2br(htmlspecialchars(mb_strimwidth(strip_tags($offre['description']),0,180,'...'))) ?></p>
                <div class="fw-bold mb-2">À partir de <span class="text-primary"><?= number_format($offre['price'],2,',',' ') ?> Ar</span></div>
                <a href="#offre<?= $offre['id'] ?>" class="btn btn-primary">Voir l’offre</a>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#offresCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#offresCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
      <!-- Sections d'offres dynamiques -->
      <?php foreach($offers as $idx => $offre): ?>
        <div id="offre<?= $offre['id'] ?>" class="row align-items-center mb-5<?= $idx % 2 === 1 ? ' flex-md-row-reverse' : '' ?>">
          <div class="col-md-5">
            <?php if($offre['image']): ?>
              <img src="../uploads/<?= htmlspecialchars($offre['image']) ?>" class="w-100 offre-img" alt="<?= htmlspecialchars($offre['title']) ?>">
            <?php else: ?>
              <img src="https://via.placeholder.com/800x220?text=Offre" class="w-100 offre-img" alt="Image par défaut">
            <?php endif; ?>
          </div>
          <div class="col-md-7">
            <h3><?= htmlspecialchars($offre['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($offre['description'])) ?></p>
            <div class="fw-bold mb-2">À partir de <span class="text-primary"><?= number_format($offre['price'],2,',',' ') ?> Ar</span></div>
            <a href="#" class="btn btn-outline-primary">Voir l’offre</a>
          </div>
        </div>
        <?php if($idx < count($offers)-1): ?><hr class="divider"><?php endif; ?>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="alert alert-warning text-center">Aucune offre disponible pour le moment.</div>
    <?php endif; ?>
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
