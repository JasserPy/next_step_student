<?php
require("db1_connection.php");
require("db_connection.php");

$sql = "SELECT * FROM universites_publiques"; // Make sure this query fetches latitude and longitude
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGSTUDENT3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <div>
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
                            <a class="btn btn-primary btn-sm ms-2"
                                href="../project/loginout/loginoutp.php">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm ms-2"
                                href="loginoutp.php">Inscription</a>
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
    </div>

    <!-- Header Section -->
    <header class="bg-primary text-white text-center py-5 position-relative">
        <div class="header-box">
            <?php
            if(!$o){
                echo"
                <h1 class='display-4 fw-bold'>NSSTUDENT</h1>
                <p class='lead'>Explorez Votre Avenir – Trouvez les Meilleures Options d'Orientation Post-Bac</p>
                <p class='header-description'>
                    Utilisez notre plateforme pour découvrir les universités proches, débloquer des opportunités
                    internationales, et gagner des certifications pour booster votre carrière.
                </p>
                <div class='header-buttons mt-4'>
                    <a href='../project/loginout/loginoutp.php' class='btn btn-light btn-lg me-3'>Connexion</a>
                    <a href='../project/loginout/loginoutp.php' class='btn btn-light btn-lg'>Inscription</a>
                </div>
            ";
            }
            else{
                echo"
                <h1 class='display-4 fw-bold'>NSSTUDENT</h1>
                <h2>WELCOME</h2>
                <p class='lead'>Explorez Votre Avenir – Trouvez les Meilleures Options d'Orientation Post-Bac</p>
                <p class='header-description'>
                    Utilisez notre plateforme pour découvrir les universités proches, débloquer des opportunités
                    internationales, et gagner des certifications pour booster votre carrière.
                </p>
            ";}?>
        </div>
    </header>

    <!-- Faculties Section -->
    <section id="faculties" class="container my-5">
        <div class="left-section">
            <h2>Découvrez les Meilleures Options <br>d'Orientation pour Vous</h2>
            <p>Cette section utilise la localisation pour montrer les universités proches<br> avec les
                spécialités disponibles.</p>
            <img src="images/pos1.png" alt="Logo de position" class="logo-absolute">
            <div class="position">
                <h2>Mahdia</h2>
            </div>
        </div>
        <div class="row g-4" id="faculties-list">
            <?php
    // Check if there are results
    if ($result->num_rows > 0) {
        // Loop through each faculty and display it
        while ($row = $result->fetch_assoc()) {
            // Replace 'latitude' and 'longitude' with the actual columns that store the coordinates in your database
            echo '<div class="col-md-4 faculty-card" 
                    data-lat="' . $row["latitude"] . '" 
                    data-lon="' . $row["longitude"] . '">
                    <div class="card text-center">
                        <img src="img fac/' . utf8_encode($row["image"]) . '.jpg" alt="Image de ' . $row["nom"] . '" class="img-fluid card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">' . $row["nom"] . '</h5>
                            <p class="card-text"><strong>Spécialités:</strong> ' . $row["specialites"] . '</p>
                            <p class="card-text"><strong>Localisation:</strong> ' . $row["localisation"] . '</p>
                            <p class="card-text"><strong>Site Web:</strong> <a href="' . $row["site_web"] . '" target="_blank">Visitez</a></p>
                        </div>
                    </div>
                </div>';
        }
    } else {
        echo "<p><h1>Aucune faculté disponible.</h1></p>";
    }
    ?>
        </div>

        <a href="faculties.php" class="btn btn-primary btn-lg mt-3">Voir Plus</a>
    </section>

    <!-- Add a button to start the quiz -->
    <div class="text-center my-5">
        <button id="start-quiz-btn" class="btn btn-primary btn-lg">Start Quiz</button>
    </div>

    <!-- JavaScript to handle the button click -->
    <script>
    document.getElementById("start-quiz-btn").addEventListener("click", function() {
        fetch("http://127.0.0.1:5000/start-quiz", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                // Redirect the user to the Flask app's quiz page
                window.location.href = "http://127.0.0.1:5000";
            } else {
                alert("Failed to start the quiz.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while starting the quiz.");
        });
    });
    </script>

    <!-- Global Opportunities Section -->
    <section class="global bg-light py-5">
        <div class="container text-center">
            <h2>Débloquez des Opportunités Mondiales</h2>
            <p class="mt-3">Découvrez des formations et certifications internationales.</p>
            <?php
            if(!$o){
                echo "<a href=''../project/loginout/loginoutp.php'' class='btn btn-primary btn-lg mt-3'>En Savoir Plus </a> "  ;
            }
            else{
                echo "<a href='global.php class='btn btn-primary btn-lg mt-3'>En Savoir Plus</a> ";
            }
            ?>
        </div>
    </section>

    <!-- Resources Section -->
    <section id="resources" class="container my-5">
        <h2 class="text-center mb-4">Améliorez Vos Compétences et Développez Votre Personnalité</h2>
        <div class="row g-4">
            <!-- Resource Cards -->
            <div class="col-md-4 text-center">
                <div class="resource-card shadow-sm p-3 rounded">
                    <img src="images/maxresdefault.jpg" alt="Image de développement personnel"
                        class="img-fluid faculty-img">
                    <h3 class="mt-3">Développement Personnel</h3>
                    <p>Apprenez à mieux gérer votre temps et votre communication.</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="resource-card shadow-sm p-3 rounded">
                    <img src="images/khor.png" alt="Image de livres" class="img-fluid faculty-img">
                    <h3 class="mt-3">Livres pour Étudiants</h3>
                    <p>Découvrez des livres pour explorer votre domain. <br><br></p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="resource-card shadow-sm p-3 rounded">
                    <img src="images/mic student.jpg" alt="Image de certifications" class="img-fluid faculty-img">
                    <h3 class="mt-3">Certifications Internationales</h3>
                    <p>Accédez à des certifications Google et Microsoft.<br><br></p>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn-primary">See More</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>