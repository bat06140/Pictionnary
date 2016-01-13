<link href="css/bootstrap.min.css" rel="stylesheet">
<a href="inscription.php">Inscrivez-vous</a>
<div class="container">
    <h2>Connectez-vous</h2>
    <form class="connexion form-horizontal" action="req_login.php" method="post" name="connexion">

            <div class="form-group">
                <label for="email">E-mail :</label>
                <input class="form-control" type="email" name="email" id="email" autofocus/>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input class="form-control" type="password" name="password" id="password"/>
            </div>
        <input type="submit" class="btn btn-default" value="Connexion">

    </form>
</div>