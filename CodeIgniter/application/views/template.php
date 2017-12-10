<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar bg-light">
        <!--@TODO Changer le # pour l'adresse de la liste de produit-->
            <a class="navbar-brand" href="#">OpenFoodFacts</a>
        </nav>

        <div class="container">
            <?php $this->load->view($content); ?>
        </div>
    </body>
</html>
