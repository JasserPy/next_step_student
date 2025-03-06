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
    <title>CONTACT</title>
    <link rel="stylesheet" href="styles/styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Ensure content isn't hidden behind the fixed navbar */
    body {
        padding-top: 70px;
        /* Adjust based on navbar height */
    }
    </style>
    <link rel="stylesheet" href="styles/styles.css">

</head>

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
    <!-- Contact Form -->
    <div class="container">
        <h1>Contact Us</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars(trim($_POST['name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $message = htmlspecialchars(trim($_POST['message']));

            if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
                $emailContent = "From: $name\nEmail: $email\nMessage:\n$message\n-----------------------------------\n";
                $filePath = 'emails.txt';

                if (file_put_contents($filePath, $emailContent, FILE_APPEND)) {
                    echo "<p class='success'>Message saved successfully!</p>";
                } else {
                    echo "<p class='error'>Failed to save the message. Please try again.</p>";
                }
            } else {
                echo "<p class='error'>Please fill in all fields with valid data.</p>";
            }
        }
        ?>

        <form action="contact.php" method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your full name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email address" required>

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" placeholder="Write your message here" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>
</body>

</html>