<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['user'])) { header("Location: ../auth/login.php"); exit; }
require_once("../config/db.php");
// Supprimer les réservations expirées (checkout passé)
mysqli_query($conn, "DELETE FROM reservations WHERE checkout < CURDATE()");
if (!isset($_GET['id'])) { header("Location: index.php"); exit; }
$id = (int)$_GET['id'];
$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($res);
if (!$product) { header("Location: index.php"); exit; }

$err = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $checkin = $_POST['checkin'];
  $checkout = $_POST['checkout'];
  $guests = max(1, (int)$_POST['guests']);

  // Vérifier que les dates sont valides
  if (!$checkin || !$checkout) {
    $err = "Veuillez sélectionner des dates.";
  } elseif ($checkin < date('Y-m-d')) {
    $err = "La date d'arrivée ne peut pas être dans le passé.";
  } elseif ($checkout <= $checkin) {
    $err = "La date de départ doit être après la date d'arrivée.";
  } else {
    // Préparer l'insertion
  // La réservation expire à la date de checkout
  $stmt2 = mysqli_prepare($conn, "INSERT INTO reservations (user_id, product_id, checkin, checkout, guests, expires_at) VALUES (?,?,?,?,?, ?)");
  mysqli_stmt_bind_param($stmt2, "iissis", $_SESSION['user']['id'], $id, $checkin, $checkout, $guests, $checkout);
    
    if (mysqli_stmt_execute($stmt2)) {
      // Mettre à jour le stock
      mysqli_query($conn, "UPDATE products SET stock = stock - 1 WHERE id = $id AND stock > 0");
      $new_id = mysqli_insert_id($conn);
      header("Location: confirmation.php?id=" . $new_id);
      exit;
    } else {
      $err = "Erreur lors de la réservation.";
    }
  }
}

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Réserver - Booka</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    .hero { background: url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat; min-height:300px; border-radius:1rem; }
    .hero-overlay { background: rgba(0,0,0,.45); border-radius:1rem; }
    .card-img-top { height: 180px; object-fit: cover; }
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
        <li class="nav-item"><a href="index.php" class="nav-link">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="#offres">Offres</a></li>
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
  <div class="row g-4">
    <div class="col-md-5">
      <?php if($product['image']): ?><img src="../uploads/<?= htmlspecialchars($product['image']) ?>" class="img-fluid rounded"><?php endif; ?>
    </div>
    <div class="col-md-7">
      <h3 class="mb-1"><?= htmlspecialchars($product['name']) ?></h3>
      <p class="text-muted"><?= htmlspecialchars($product['location']) ?></p>
      <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
      <div class="border rounded p-3 bg-light">
        <h5>Réserver</h5>
        <?php if(!empty($err)): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($err) ?></div>
        <?php endif; ?>
        <form method="post">
          <div class="row g-2">
            <div class="col-md-4">
              <label class="form-label">Check-in</label>
              <input type="date" name="checkin" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Check-out</label>
              <input type="date" name="checkout" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Voyageurs</label>
              <input type="number" name="guests" min="1" class="form-control" value="1" required>
            </div>
          </div>
          <button class="btn btn-primary mt-3">Confirmer la réservation</button>
        </form>
      </div>
    </div>
  </div>
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
