<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FAQ - Booka</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Booka</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
      </ul>
    </div>
  </div>
</nav>
<main class="py-5">
  <div class="container" style="max-width:800px;">
    <h2 class="mb-4 text-center">Foire aux questions (FAQ)</h2>
    <div class="accordion" id="faqAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Comment réserver un produit ?
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Pour réserver, cliquez sur le bouton "Réserver" du produit souhaité et suivez les instructions.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Comment annuler une réservation ?
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Vous pouvez annuler une réservation depuis la page "Mes réservations" ou contacter l'assistance.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Que faire en cas de problème technique ?
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Contactez notre support technique via le formulaire de contact ou par email.
          </div>
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
