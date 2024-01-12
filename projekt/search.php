<?php

// Adatbázis kapcsolat beállítása
$servername = "localhost";
$username = ""; // üres string, nincs felhasználónév
$password = ""; // üres string, nincs jelszó
$dbname = "products";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}

$kereses = isset($_GET['kereses']) ? $_GET['kereses'] : '';

$sql = "SELECT * FROM climas WHERE nev LIKE '%$kereses%' OR marka LIKE '%$kereses%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='termek'>";
        echo "<h3>" . $row['nev'] . "</h3>";
        echo "<p><strong>Márka:</strong> " . $row['marka'] . "</p>";
        echo "<p><strong>Energia:</strong> " . $row['energia'] . "</p>";
        echo "<p><strong>Típus:</strong> " . $row['tipus'] . "</p>";
        echo "<p><strong>Ár:</strong> " . $row['ar'] . "</p>";
        echo "<p><strong>Szín:</strong> " . $row['szin'] . "</p>";
        echo "<p><strong>Leírás:</strong> " . $row['leiras'] . "</p>";
        echo "<p><strong>Tulajdonságok:</strong> " . $row['tulajdonsagok'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>Nincs találat.</p>";
}

$conn->close();
?>
