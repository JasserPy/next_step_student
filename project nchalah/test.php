<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "next_step_student";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer et afficher les universités publiques
$sql_publiques = "SELECT nom, type, localisation, universite_principale, specialites, site_web FROM universites_publiques";
$result_publiques = $conn->query($sql_publiques);

echo "<h2>Universités publiques</h2>";
if ($result_publiques->num_rows > 0) {
    while($row = $result_publiques->fetch_assoc()) {
        echo "Nom: " . $row["nom"]. "<br>";
        echo "Type: " . $row["type"]. "<br>";
        echo "Localisation: " . $row["localisation"]. "<br>";
        echo "Université principale: " . $row["universite_principale"]. "<br>";
        echo "Spécialités: " . $row["specialites"]. "<br>";
        echo "Site Web: " . $row["site_web"]. "<br><br>";
    }
} else {
    echo "Aucune université publique trouvée";
}

// Récupérer et afficher les universités privées
$sql_privees = "SELECT nom, localisation, site_web FROM universites_privees";
$result_privees = $conn->query($sql_privees);

echo "<h2>Universités privées</h2>";
if ($result_privees->num_rows > 0) {
    while($row = $result_privees->fetch_assoc()) {
        echo "Nom: " . $row["nom"]. "<br>";
        echo "Localisation: " . $row["localisation"]. "<br>";
        echo "Site Web: " . $row["site_web"]. "<br><br>";
    }
} else {
    echo "Aucune université privée trouvée";
}

// Récupérer et afficher les ressources gouvernementales
$sql_ressources = "SELECT nom, description, site_web FROM ressources_gouvernementales";
$result_ressources = $conn->query($sql_ressources);

echo "<h2>Ressources gouvernementales</h2>";
if ($result_ressources->num_rows > 0) {
    while($row = $result_ressources->fetch_assoc()) {
        echo "Nom: " . $row["nom"]. "<br>";
        echo "Description: " . $row["description"]. "<br>";
        echo "Site Web: " . $row["site_web"]. "<br><br>";
    }
} else {
    echo "Aucune ressource gouvernementale trouvée";
}

$conn->close();
?>