<?php
/**
 * Created by PhpStorm.
 * User: FG
 * Date: 13/01/2016
 * Time: 00:23
 */
session_start();
if(isset($_SESSION['email']))
{?>
    <div class="alert alert-info">Bonjour <?php echo $_SESSION['prenom']; ?> </div>
    <img src=" <?php echo $_SESSION['profilepic']; ?> ">
    <a href="./logout.php">Logout</a>
<?php
}
else
{
?>
    <div class="container">
        <h2>Connectez-vous</h2>
        <form class="connexion" action="req_login.php" method="post" name="connexion">
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="email">E-mail :</label>
                    <input class="form-control" type="email" name="email" id="email" autofocus/>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input class="form-control" type="password" name="password" id="password"/>
                </div>
            </form>
        </form>
        <a href="inscription.php">Inscrivez-vous</a>
    </div>
<?php
}
?>
