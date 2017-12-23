<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/icon/fontawessom-all.css'); ?>" rel="stylesheet">
    <style>
        #background {
            height: 150px;
            background-image:url(<?php echo base_url()."assets/image/background/".rand(1,9).".jpg" ?>);
            background-size: cover;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-light">
        <a class="navbar-brand" href='<?php echo base_url()."index.php/Produits/listProduct/" ?>'>OpenFoodFacts</a>

    </nav>

    <div id="background"></div>

    <div class="container">
        <?php $this->load->view($content); ?>
    </div>
    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
