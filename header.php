<?php
/**
 * Created by PhpStorm.
 * User: FG
 * Date: 13/01/2016
 * Time: 00:23
 */
session_start();
if(isset($_SESSION['user']['email']))
{?>
    <div class="alert alert-info">Bonjour <?php echo $_SESSION['user']['prenom']; ?> </div>
    <img src=" <?php echo $_SESSION['user']['profilepic']; ?> ">
    <a href="./logout.php">Logout</a>
<?php
}
else
{
?>
    <a href="./connexion.php">Connexion</a>
<?php
}
?>
