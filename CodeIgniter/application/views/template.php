<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('form');
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
            <?php echo form_open('Produits/formSearchProductByName'); ?>
            <input type="text" name="nameProduct" placeholder="Recherche par nom">
            <button type='submit' class= 'btn btn-primary'  value="Rechercher">Rechercher</button>
            <a href="<?php echo site_url().'/recherche'?>"><button type='button' class= 'btn btn-primary'  value="Recherche avancée...">Recherche avancée...</button></a>
            </form>



        </nav>

        <div class="container">
            <?php $this->load->view($content); ?>
        </div>
    </body>
</html>
