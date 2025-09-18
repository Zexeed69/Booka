<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

require_once("../config/db.php");
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (!$username || !$email || !$password || !$confirm) {
        $message = "Veuillez remplir tous les champs.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse email invalide.";
    } elseif ($password !== $confirm) {
        $message = "Les mots de passe ne correspondent pas.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email=?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $message = "Un compte existe déjà avec cet email.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user';
            $stmt2 = mysqli_prepare($conn, "INSERT INTO users (username, email, password, role) VALUES (?,?,?,?)");
            mysqli_stmt_bind_param($stmt2, "ssss", $username, $email, $hashed, $role);
            if (mysqli_stmt_execute($stmt2)) {
                $message = "Inscription réussie. Vous pouvez vous connecter.";
            } else {
                $message = "Erreur lors de l'inscription.";
            }
        }
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription - Booka</title>
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
    <a class="navbar-brand fw-bold" href="/public/index.php">Booka</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="../public/index.php">Accueil</a></li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if(empty($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Connexion</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Créer un compte</a></li>
        <?php else: ?>
          <li class="nav-item"><span class="navbar-text text-white me-2">Bonjour, <?= htmlspecialchars($_SESSION['user']['username']) ?></span></li>
          <li class="nav-item"><a class="btn btn-light btn-sm" href="logout.php">Déconnexion</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<main class="py-4">
<div class="container" style="max-width:520px;">
  <h3 class="mb-3">Créer un compte</h3>
  <?php if(!empty($message)): ?><div class="alert alert-info"><?= htmlspecialchars($message) ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Nom d'utilisateur</label>
      <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Mot de passe</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Confirmer le mot de passe</label>
      <input type="password" name="confirm" class="form-control" required>
    </div>
    <button class="btn btn-primary w-100">S'inscrire</button>
    <p class="mt-2 small">Déjà un compte ? <a href="login.php">Se connecter</a></p>
  </form>
</div>
</main>
<footer class="border-top py-4 text-center small text-muted fixed-bottom">
  © <?php echo date('Y'); ?> Booka — Mini projet style Booking.com
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
