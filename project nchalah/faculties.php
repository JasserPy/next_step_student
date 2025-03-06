<?php
require("db1_connection.php");
require("db_connection.php");

$sql = "SELECT * FROM universites_publiques"; // Make sure the query is correct
$result = $conn->query($sql); // Execute the query

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toutes les Facultés</title>
    <link rel="stylesheet" href="styles/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Ensure content isn't hidden behind the fixed navbar */
    body {
        padding-top: 70px;
        /* Adjust based on navbar height */
    }

    #faculties {
        padding-top: 70px;
        /* Adjust the value based on the navbar height */
    }

    .faculty-card {
        width: 300px;
        /* Set a fixed width for all cards */
        height: 400px;
        /* Set a fixed height for all cards */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 16px;
        margin: 0 auto;
        /* Center-align the card */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .faculty-card img {
        width: auto;
        /* Scale the image to fit within the card */
        height: 80%;
        /* Maintain aspect ratio */
        max-width: 150px;
        /* Prevent the image from exceeding a specific height */
        object-fit: cover;
        border-radius: 4px;
    }

    .faculty-card h3 {
        font-size: 1.2rem;
        /* Adjust the title size */
        margin: 10px 0;
    }

    .faculty-card p {
        font-size: 0.9rem;
        /* Adjust text size for readability */
        text-align: center;
        margin: 4px 0;
    }

    .faculty-card a {
        text-decoration: none;
        color: #007BFF;
        font-weight: bold;
    }

    .faculty-card:hover {
        transform: translateY(-5px);
        /* Slight hover effect */
    }
    </style>
    <link rel="stylesheet" href="styles/styles.css">

</head>
<script>
// Check if the URL already contains 'lat' and 'lon' parameters
if ("geolocation" in navigator && !window.location.search.includes('lat') && !window.location.search.includes('lon')) {
    navigator.geolocation.getCurrentPosition(function(position) {
        // Get the latitude and longitude of the user's position
        var userLat = position.coords.latitude;
        var userLon = position.coords.longitude;

        // Construct the URL with lat and lon as query parameters
        var newUrl = window.location.href.split('?')[0] + '?lat=' + userLat + '&lon=' + userLon;

        // Redirect to the same page with the user's location in the URL
        window.location.href = newUrl;
    }, function(error) {
        alert("Unable to retrieve your location.");
    });
} else {
    // Handle case when location is already in the URL (no need to reload)
    console.log("Location already available in the URL.");
}
</script>

<body>

    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <!-- Left Logo and Brand -->
            <div class="d-flex align-items-center">
                <img src="images/logo.png" alt="NSSTUDENT Logo" width="50px" height="50px" class="logo me-2">
                <a class="navbar-brand" href="#">NSSTUDENT</a>
            </div>

            <!-- Navbar Toggler Button for Small Screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Ensure ms-auto is applied here for right alignment -->
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="faculties.php">Faculties</a></li>
                    <li class="nav-item"><a class="nav-link" href="facetranges.php">Global Opportunities</a></li>
                    <li class="nav-item"><a class="nav-link" href="resources.php">Resources</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>

                    <!-- Search Bar -->
                    <li class="nav-item">
                        <form class="d-flex ms-2" action="search.php" method="GET">
                            <input class="form-control me-2" type="search" name="query" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>

                    <!-- Buttons (Connexion and Inscription) aligned to the right -->
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm ms-2" href="../project/loginout/loginoutp.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm ms-2" href="../project/loginout/loginoutp.php">Inscription</a>
                    </li>

                    <!-- Account Icon -->
                    <li class="nav-item">
                        <?php if(!$o) {
                        echo "<a href='../project/loginout/loginoutp.php' class='nav-link ms-2' id='account-icon'>
                            <i class='fas fa-user-circle fa-lg'>Sign in</i>
                        </a>";
                    } else {
                        header("Location: ../isima/etudiant1.php?emails= ");
                        echo "<a href='../project/loginout/loginoutp.php' class='nav-link ms-2' id='account-icon'>
                            <i class='fas fa-user-circle fa-lg'>jasser</i>
                        </a>";
                    } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1>Your Location</h1>
    <p id="location-info">Loading location...</p>

    <script src="getLocation.js"></script>
    <!-- Faculties Section -->
    <section id="faculties" class="container my-5">
        <h2>Toutes les Facultés</h2>
        <p>Découvrez les universités publiques disponibles en Tunisie avec leurs spécialités.</p>

        <div class="row g-4" style="margin: 0; width: 100%;"> <?php
    // Function to calculate the distance between two locations using Haversine formula
    function calculate_distance($lat1, $lon1, $lat2, $lon2) {
        $earth_radius = 6371; // Earth radius in kilometers

        // Convert degrees to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Haversine formula
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) +
             cos($lat1) * cos($lat2) *
             sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earth_radius * $c; // Distance in kilometers

        return $distance;
    }

    // Fetch user location from URL query parameters
    $user_lat = isset($_GET['lat']) && is_numeric($_GET['lat']) ? $_GET['lat'] : 0;
    $user_lon = isset($_GET['lon']) && is_numeric($_GET['lon']) ? $_GET['lon'] : 0;

    if ($user_lat && $user_lon) {
        // Array to hold faculties and their distances
        $faculties = array();

        // Fetch faculties from the database
        $result = $conn->query("SELECT * FROM universites_publiques");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Check if latitude and longitude are present in the row
                if (!empty($row['latitude']) && !empty($row['longitude'])) {
                    $faculty_lat = $row['latitude'];
                    $faculty_lon = $row['longitude'];

                    // Calculate distance between the user and the faculty using the Haversine formula
                    $distance = calculate_distance($user_lat, $user_lon, $faculty_lat, $faculty_lon);

                    // Store faculty data and distance
                    $faculties[] = array(
                        'name' => utf8_encode($row["nom"]),
                        'specialties' => utf8_encode($row["specialites"]),
                        'location' => utf8_encode($row["localisation"]),
                        'website' => $row["site_web"],
                        'latitude' => $faculty_lat,
                        'longitude' => $faculty_lon,
                        'distance' => $distance,
                        'image' => utf8_encode($row["image"])
                    );
                } else {
                    echo "<p>Faculty data incomplete: " . htmlspecialchars($row['nom']) . "</p>";
                }
            }

            // Sort faculties by distance (ascending order)
            usort($faculties, function($a, $b) {
                return $a['distance'] - $b['distance'];
            });

            // Display the faculties
            foreach ($faculties as $faculty) {
                echo '<div class="faculty-card">';
                echo '<img src="img fac/' . $faculty['image'] . '.jpg" alt="Image de ' . $faculty['name'] . '" class="img-fluid">';
                echo '<h3>' . $faculty['name'] . '</h3>';
                echo '<p><strong>Spécialités:</strong> ' . $faculty['specialties'] . '</p>';
                echo '<p><strong>Localisation:</strong> ' . $faculty['location'] . '</p>';
                echo '<p><strong>Site Web:</strong> <a href="' . $faculty['website'] . '" target="_blank">Visitez</a></p>';
                echo '<p><strong>Distance:</strong> ' . number_format($faculty['distance'], 2) . ' km</p>';
                echo '</div>';
            }
        } else {
            echo "<p>Aucune faculté disponible.</p>";
        }
    } else {
        echo "Unable to determine location.";
    }
    ?>

        </div>
    </section>

    <!-- Footer Section -->
    <footer class="text-center bg-dark text-white py-5">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Footer Left -->
            <div class="footer-left">
                <a href="https://www.linkedin.com/in/mohamed-jasser-hamrouni-7186a0297/" class="text-white me-3"
                    target="_blank">
                    <i class="fab fa-linkedin"></i> LinkedIn
                </a>
                <a href="https://github.com/JasserPy" class="text-white me-3" target="_blank">
                    <i class="fab fa-github"></i> GitHub
                </a>
                <a href="mailto:someone@example.com" class="text-white">
                    <i class="fas fa-envelope"></i> Email
                </a>
                <p class="text-white mt-3">About NGSTUDENT: NGSTUDENT is a platform dedicated to helping
                    students find
                    the best post-baccalaureate options and improve their skills for a successful career.</p>
                <p>&copy; 2024 NGSTUDENT. Tous droits réservés.</p>
            </div>
            <!-- Footer Right -->
            <div class="footer-right">
                <img src="images/frame.png" alt="QR Code" class="img-fluid" style="max-width: 120px;">
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS (for responsive navbar) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>