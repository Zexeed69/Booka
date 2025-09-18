<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once("../config/db.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
  $del_id = (int)$_POST['delete_id'];
  // Récupérer l'id du produit associé à la réservation
  $res = mysqli_query($conn, "SELECT product_id FROM reservations WHERE id = $del_id");
  if ($row = mysqli_fetch_assoc($res)) {
    $product_id = (int)$row['product_id'];
    // Supprimer la réservation
    mysqli_query($conn, "DELETE FROM reservations WHERE id = $del_id");
    // Incrémenter le stock du produit
    mysqli_query($conn, "UPDATE products SET stock = stock + 1 WHERE id = $product_id");
  } else {
    // Si la réservation n'existe plus, juste supprimer
    mysqli_query($conn, "DELETE FROM reservations WHERE id = $del_id");
  }
  header("Location: reservations.php");
  exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Réservations</title>
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
?>
<?php require_once("../config/db.php"); ?>
<div class="container">
  <h3 class="mb-3">Réservations</h3>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead><tr><th>#</th><th>Client</th><th>Produit</th><th>Check-in</th><th>Check-out</th><th>Voyageurs</th><th>Status</th></tr></thead>
      <tbody>
        <?php
        $q="SELECT r.*, u.username, p.name AS product_name FROM reservations r
            JOIN users u ON r.user_id=u.id
            JOIN products p ON r.product_id=p.id
            ORDER BY r.id DESC";
        $res=mysqli_query($conn,$q);
        while($row=mysqli_fetch_assoc($res)): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['product_name']) ?></td>
            <td><?= htmlspecialchars($row['checkin']) ?></td>
            <td><?= htmlspecialchars($row['checkout']) ?></td>
            <td><?= (int)$row['guests'] ?></td>
            <td>
              <form method="post" action="update_res_status.php" class="d-flex gap-2">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                  <option value="pending" <?= $row['status']=='pending'?'selected':''; ?>>En attente</option>
                  <option value="confirmed" <?= $row['status']=='confirmed'?'selected':''; ?>>Confirmée</option>
                  <option value="cancelled" <?= $row['status']=='cancelled'?'selected':''; ?>>Annulée</option>
                </select>
              </form>
            </td>
            <td>
                <form method="post" style="display:inline-block;" onsubmit="return confirm('Supprimer cette réservation ?');">
                <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                <button type="submit" class="btn btn-danger btn-sm ms-2">Supprimer</button>
              </form>
              </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
</main>
<footer class="border-top py-4 text-center small text-muted bg-white fixed-bottom">
  © <?php echo date('Y'); ?> Booka — Mini projet style Booking.com
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

