<?php

    // récupérer les éléments du formulaire
    // et se protéger contre l'injection MySQL (plus de détails ici: http://us.php.net/mysql_real_escape_string)
    $email = stripslashes($_POST['email']);
    $password = stripslashes($_POST['password']);
    $nom = stripslashes($_POST['nom']);
    $prenom = stripslashes($_POST['prenom']);
    $tel = stripslashes($_POST['tel']);
    $website = stripslashes($_POST['website']);
    $sexe = '';

    if (array_key_exists('sexe', $_POST)){
        $sexe = stripslashes($_POST['sexe']);
    }

    $birthdate = stripslashes($_POST['birthdate']);
    $ville = stripslashes($_POST['ville']);
    $taille = stripslashes($_POST['taille']);
    $couleur = stripslashes($_POST['couleur']);
    $profilepic = stripslashes($_POST['profilepic']);

    try {
        // Connect to server and select database.
        $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test','');

        // Vérifier si un utilisateur avec cette adresse email existe dans la table.
        // En SQL: sélectionner tous les tuples de la table USERS tels que l'email est égal à $email.
        $sql = $dbh->prepare("SELECT * FROM users WHERE email='".$email."'");
        $sql->execute();
        $nbRow=count($sql->fetchAll());
        if ($nbRow>=1) {

            $error="Email déjà existant";
            $params= "?nom=".$nom."&prenom=".$prenom."&tel=".$tel."&website=".$website."&sexe=".$sexe."&birthdate=".$birthdate."&ville=".$ville."&taille=".$taille."&couleur=".$couleur."&profilpic=".$profilepic;
            header('Location: ./inscription.php'.$params);

            // rediriger l'utilisateur ici, avec tous les paramètres du formulaire plus le message d'erreur
            // utiliser à bon escient la méthode htmlspecialchars http://www.php.net/manual/fr/function.htmlspecialchars.php          // et/ou la méthode urlencode http://php.net/manual/fr/function.urlencode.php
        }
        else {
            // Tenter d'inscrire l'utilisateur dans la base
            $sql = $dbh->prepare("INSERT INTO users (email, password, nom, prenom, tel, website, sexe, birthdate, ville, taille, couleur, profilepic) "
                . "VALUES (:email, :password, :nom, :prenom, :tel, :website, :sexe, :birthdate, :ville, :taille, :couleur, :profilepic)");
            $valeur=array(
                "email" => $email,
                "password" => $password,
                "nom" => $nom,
                "prenom" => $prenom,
                "tel" => $tel,
                "website" => $website,
                "sexe" => $sexe,
                "birthdate" => $birthdate,
                "ville" => $ville,
                "taille" => $taille,
                "couleur" => $couleur,
                "profilepic" => $profilepic
                );
            // de même, lier la valeur pour le mot de passe
            // lier la valeur pour le nom, attention le nom peut être nul, il faut alors lier avec NULL, ou DEFAULT
            // idem pour le prenom, tel, website, birthdate, ville, taille, profilepic
            // n.b., notez: birthdate est au bon format ici, ce serait pas le cas pour un SGBD Oracle par exemple
            // idem pour la couleur, attention au format ici (7 caractères, 6 caractères attendus seulement)
            // idem pour le prenom, tel, website
            // idem pour le sexe, attention il faut être sûr que c'est bien 'H', 'F', ou ''

            // on tente d'exécuter la requête SQL, si la méthode renvoie faux alors une erreur a été rencontrée.
            if (!$sql->execute($valeur)) {
                echo "PDO::errorInfo():<br/>";
                $err = $sql->errorInfo();
                print_r($err);
            } else {

                // ici démarrer une session
                session_start();
                // ensuite on requête à nouveau la base pour l'utilisateur qui vient d'être inscrit, et
                $sql = $dbh->query("SELECT u.id, u.email, u.nom, u.prenom, u.couleur, u.profilepic FROM USERS u WHERE u.email='" . $email . "'");
                if ($sql->rowCount() < 1) {
                    header("Location: main.php?erreur=" . urlencode("un problème est survenu"));
                } else {
                    // on récupère la ligne qui nous intéresse avec $sql->fetch(),
                    $result=$sql->fetch(PDO::FETCH_ASSOC);
                    // et on enregistre les données dans la session avec $_SESSION["..."]=...
                    $_SESSION["email"]=$valeur["email"];
                    $_SESSION["nom"]=$valeur["nom"];
                    $_SESSION["prenom"]=$valeur["prenom"];
                    $_SESSION["tel"]=$valeur["tel"];
                    $_SESSION["website"]=$valeur["website"];
                    $_SESSION["sexe"]=$valeur["sexe"];
                    $_SESSION["birthdate"]=$valeur["birthdate"];
                    $_SESSION["ville"]=$valeur["ville"];
                    $_SESSION["taille"]=$valeur["taille"];
                    $_SESSION["couleur"]=$valeur["couleur"];
                    $_SESSION["profilepic"]=$valeur["profilepic"];
                }

                // ici,  rediriger vers la page main.php
                header('Location: ./main.php');

            }
            $dbh = null;
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        $dbh = null;
        die();
    }
?>