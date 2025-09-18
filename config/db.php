
<?php
// Database connection (MySQLi - procedural style)
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "booking_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
// Supprimer toutes les réservations expirées
// $deleteExpired = "DELETE FROM reservations WHERE date_expiration < CURDATE()";
// mysqli_query($conn, $deleteExpired);
?>
