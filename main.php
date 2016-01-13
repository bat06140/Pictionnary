<?php
/**
 * Created by PhpStorm.
 * User: FG
 * Date: 13/01/2016
 * Time: 08:37
 */
include 'header.php';
 if(isset($_SESSION['user']['email']))
{ ?>
    <div class="jumbotron" style="padding-bottom: 70px;">
        <h2 style="text-align: center">Bonjour <?php echo $_SESSION['user']['prenom']; ?> </h2>
        <img src=" <?php echo $_SESSION['user']['profilepic']; ?> ">
        <div class="col-xs-12 text-center">
            <a class="btn btn-lg btn-success" href="./paint.php" role="button">Dessiner</a>

        </div>
    </div>
    <?php
}
?>