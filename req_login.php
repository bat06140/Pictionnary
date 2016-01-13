<?php
/**
 * Created by PhpStorm.
 * User: FG
 * Date: 13/01/2016
 * Time: 09:05
 */
    $email = stripslashes($_POST['email']);
    $password = stripslashes($_POST['password']);


try {
    // Connect to server and select database.
    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test','');

    // Vérifier si un utilisateur avec cette adresse email existe dans la table.
    // En SQL: sélectionner tous les tuples de la table USERS tels que l'email est égal à $email.
    $sql = $dbh->query("SELECT * FROM users WHERE email='".$email."' AND password='".$password."'");
    if ($sql->rowCount()==1) {

        session_start();

        $_SESSION['user']=$sql->fetchAll(PDO::FETCH_ASSOC)[0];

        header('Location: ./main.php');
    }
    else {
        $error='Email ou mot de passe incorrect !';
        header('Location: ./main.php&error='.$error);
    }
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $dbh = null;
    die();
}