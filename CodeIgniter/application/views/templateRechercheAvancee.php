<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('form');
$this->load->helper('url');
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar bg-light">
            <a class="navbar-brand" href='<?php echo base_url()."index.php/Produits/listProduct/" ?>'>OpenFoodFacts</a>
        </nav>

        <div class="container">
            <?php $this->load->view($content); ?>
        </div>
    </body>
</html>
