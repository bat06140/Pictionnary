<?php
    include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pictionnary - Inscription</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <div class="container">
        <h2>Inscrivez-vous</h2>
        <form class="inscription" action="req_inscription.php" method="post" name="inscription">
            <!-- c'est quoi les attributs action et method ? -->
            <!-- qu'y a-t-il d'autre comme possiblité que post pour l'attribut method ? -->
            <?php
                if(empty($error)){ ?>
                    <div class="alert alert-info">Les champs obligatoires sont indiqués par *</div>
            <?php }
                else{ ?>
                    <div class="alert alert-danger">Email déjà existant !</div>
                <?php }
            ?>


                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="email">E-mail :</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="name@something.com" value="<?php if(isset($_GET['email'])) { echo htmlspecialchars($_GET['email']);}?>" required autofocus/>
                            <!-- quelle est la différence entre les attributs name et id ? -->
                            <!-- name sert pour le php et id pour css et js -->
                            <!-- c'est lequel qui doit être égal à l'attribut for du label ? -->
                            <!-- c'est l'id -->
                        </div>

                        <div class="form-group">
                            <label for="mdp1">Mot de passe :</label>
                            <input class="form-control" type="password" name="password" id="mdp1" placeholder="Mot de passe" pattern="[a-zA-Z0-9]{6,8}" title = "Le mot de passe doit contenir de 6 à 8 caractères alphanumériques." required/>
                            <span class="form_hint">De 6 à 8 caractères alphanumériques.</span>
                        </div>

                        <div class="form-group">
                            <label for="mdp2">Confirmation du mot de passe :</label>
                            <input class="form-control" type="password" id="mdp2" placeholder="Mot de passe" pattern="[a-zA-Z0-9]{6,8}" onkeyup="validateMdp2()" required/>
                            <span class="form_hint">Les mots de passes doivent être égaux.</span>
                        </div>

                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input class="form-control" type="text" name="nom" id="nom" placeholder="Ex : Dupont" value="<?php if(isset($_GET['nom'])) { echo htmlspecialchars($_GET['nom']);}?>"/>
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prénom :</label>
                            <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Ex : Jean" value="<?php if(isset($_GET['prenom'])) { echo htmlspecialchars($_GET['prenom']);}?>" />
                        </div>

                        <div class="form-group">
                            <label for="tel">Téléphone :</label>
                            <input class="form-control" type="tel" name="tel" id="tel" placeholder="Ex : 0606060606" value="<?php if(isset($_GET['tel'])) { echo htmlspecialchars($_GET['tel']);}?>"/>
                        </div>

                        <div class="form-group">
                            <label for="website">Site web :</label>
                            <input class="form-control" type="url" name="website" id="website" placeholder="Ex : http://www.monsite.com" value="<?php if(isset($_GET['website'])) { echo htmlspecialchars($_GET['website']);}?>"/>
                        </div>

                        <div class="form-group">
                            <label for="sexe">Sexe :</label>
                            <label class="radio-inline">
                                <input type="radio" name="sexe" id="femme" value="option1">Femme
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sexe" id="homme"  value="option2">Homme
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="birthdate">Date de naissance :</label>
                            <input class="form-control" type="date" name="birthdate" id="birthdate" placeholder="jj/mm/aaaa" onchange="calculAge();" value="<?php if(isset($_GET['birthdate'])) { echo htmlspecialchars($_GET['birthdate']);}?>" required/>
                            <span class="form_hint">Format attendu "JJ/MM/AAAA"</span>
                        </div>

                        <div class="form-group">
                            <label for="Age">Age :</label>
                            <input class="form-control" type="number" name="age" id="age" disabled />
                        </div>

                        <div class="form-group">
                            <label for="ville">Ville :</label>
                            <input class="form-control" type="text" name="ville" id="ville" placeholder="Ex : Paris" value="<?php if(isset($_GET['ville'])) { echo htmlspecialchars($_GET['ville']);}?>"/>
                        </div>

                        <div class="form-group">
                            <label for="taille">Taille :<span id="inputTailleValue"></span></label>
                            <input type="range" min="0" max="2.5" step="0.01" name="taille" id="taille" oninput="refreshTaille();" value="<?php if(isset($_GET['taille'])) { echo htmlspecialchars($_GET['taille']);}?>"/>
                        </div>

                        <div class="form-group">
                            <label for="couleur">Couleur préférée :</label>
                            <input class="form-control" type="color" name="couleur" id="couleur" value="<?php if(isset($_GET['couleur'])) { echo htmlspecialchars($_GET['couleur']);}?>"/>
                        </div>

                        <div class="form-group">
                            <label for="profilepicfile">Photo de profil:</label>
                            <span class="form_hint">Choisissez une image.</span>
                            <input type="file" id="profilepicfile" onchange="loadProfilePic(this)"/>
                            <input type="hidden" name="profilepic" id="profilepic" value="<?php if(isset($_GET['profilepic'])) { echo htmlspecialchars($_GET['profilepic']);}?>"/>
                            <br>
                            <canvas id="preview" width="96" height="96" style="border: 1px; border-style: solid;"></canvas>
                        </div>

                        <input type="submit" class="btn btn-default" value="Soumettre Formulaire">

                    </form>

        </form>
    </div>
</body>
</html>

