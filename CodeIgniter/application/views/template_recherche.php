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
            <?php echo form_open('recherche/formSearchProductByName'); ?>
            
            <input type="text" name="nameProduct" placeholder=" nom">
            <input type="text" name="brandProduct" placeholder="marque">
            <input type="text" name="ingredients" placeholder="ingredients">
            
            <button type='submit' class= 'btn btn-primary'  value="Rechercher">Rechercher</button>
            </form>
            <!-- @TODO ne pas oublier de prendre le lien de nicolas -->
            <a href="#"><button type='button' class= 'btn btn-primary'  value="Recherche avancée...">retour</button></a>

        </nav>

        <div class="container">
            <?php $this->load->view($content); ?>
        </div>
    </body>
</html>
