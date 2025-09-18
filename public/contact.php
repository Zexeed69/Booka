<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact - Booka Voyages</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <style>
    .contact-card { box-shadow: 0 2px 12px rgba(0,0,0,0.08); border: none; border-radius: 1rem; }
    .contact-icon { font-size: 2rem; color: #ff6a00; }
    .contact-form { background: #fff; border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
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
        <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
        <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
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
    <h2 class="mb-4 text-center">Contactez-nous</h2>
    <div class="row g-4 mb-5">
      <div class="col-md-4">
        <div class="card contact-card p-4 text-center">
          <div class="contact-icon mb-2"><i class="bi bi-telephone"></i></div>
          <h5 class="mb-1">Téléphone</h5>
          <p class="mb-0">+261 34 12 345 67</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card contact-card p-4 text-center">
          <div class="contact-icon mb-2"><i class="bi bi-envelope"></i></div>
          <h5 class="mb-1">Email</h5>
          <p class="mb-0">contact@booka-voyages.com</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card contact-card p-4 text-center">
          <div class="contact-icon mb-2"><i class="bi bi-geo-alt"></i></div>
          <h5 class="mb-1">Adresse</h5>
          <p class="mb-0">Lot 123, Antananarivo, Madagascar</p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="p-4 contact-form">
          <h5 class="mb-3">Formulaire de contact</h5>
          <form method="post">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="col-12">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="4" required></textarea>
              </div>
            </div>
            <button class="btn btn-primary mt-3" type="submit">Envoyer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
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
