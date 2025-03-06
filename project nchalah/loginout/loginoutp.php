<?php
                if(isset($_POST['nom'])){
                $nom=$_POST['nom'];
                $email=$_POST['email'];
                $passwordd=$_POST['password'];
                $passwordconfig=$_POST['passwordconfig'];
                $mysqli = new mysqli("localhost", "root", "", "isima");
                $mysqli -> set_charset("utf8");
                if($mysqli->connect_error){
                die("connection failed: ". $mysqli->connect_error);
                }
                $id="E".(ord($nom)+ord($email))*28;
                }
        
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ISIMA</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post">
                <h1>Create Account</h1>
                <span>use your Email for registeration</span>
                <input type="text" placeholder="Name *" name="nom" value="">
                <input type="email" placeholder="Email *" name="email" value="">
                <input type="password" placeholder="password *" name="password" value="">
                <input type="password" placeholder="password configuration*" name="passwordconfig" value="" >
                <button id="sign-up">sign-uP</button>
                <?php 
if (isset($_POST['nom'])) {
    if (empty($nom) || empty($email) || empty($passwordd) || empty($passwordconfig)) {
        echo "<h4 style='color:red;'>Tous les champs sont obligatoires</h4>";
    } else {
        $is_valid_name = true;
        for ($i = 0; $i < strlen($nom); $i++) {
            if (!ctype_alpha($nom[$i]) && $nom[$i] != ' ') {
                $is_valid_name = false;
                break;
            }
        }
        if (!$is_valid_name) {
            echo "<h4 style='color:red;'>Le nom doit contenir uniquement des lettres</h4>";
        } 
        elseif (!(strpos($email, "@gmail.com") !== false)) {
            echo "<h4 style='color:red;'>L'email doit contenir '@gmail.com'</h4>";
        } 
        elseif (strlen($passwordd) < 8) {
            echo "<h4 style='color:red;'>Le mot de passe doit contenir au moins 8 caractères</h4>";
        } 
        elseif ($passwordd !== $passwordconfig) {
            echo "<h4 style='color:red;'>Veuillez vérifier votre mot de passe</h4>";
        } else {
            $sql = "INSERT INTO etudiant(id, cin, nom, prenom, email, passwordd, sexe, datee, classe)
                    VALUES('$id', '', '$nom', '', '$email', '$passwordd', '', '', '')";
            $res = $mysqli->query($sql);
            if (!$res) {
                echo "<h4 style='color:red;'>Requête invalide: </h4>" . $mysqli->error;
            } else {
                header("Location: ../etudiant/formulair_etudiant.php?id=$id");
                exit();
            }
        }
    }
}
?>

        </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-plan toggle-left">
                   
                    <h1>
                        Hello Student
                    </h1>
                    <p>enter your personal details to use all of site fetures</p>
                    <button class="hidden" id="login1">sign-in</button>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
<?php

?>