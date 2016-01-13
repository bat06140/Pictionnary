<?php
/**
 * Created by PhpStorm.
 * User: FG
 * Date: 13/01/2016
 * Time: 00:23
 */
session_start();
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
<div class="container" style="margin-top: 70px">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./main.php">Pictionnary</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if(!isset($_SESSION['user']['email'])) { ?>
                    <li <?php if($_SERVER['PHP_SELF']=='/WebSemantique/Pictionnary/connexion.php') echo 'class="active"'; ?> ><a href="./connexion.php">Connexion</a></li>
                    <li <?php if($_SERVER['PHP_SELF']=='/WebSemantique/Pictionnary/inscription.php') echo 'class="active"'; ?> ><a href="./inscription.php">Inscription</a></li>
                    <?php
                }
                ?>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION['user']['email'])) { ?>
                    <li><a href="./logout.php">Deconnexion</a></li>
                <?php
                }
                ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
