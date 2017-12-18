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
        <link href="<?php echo base_url('assets/icon/fontawesome-all.css'); ?>" rel="stylesheet">
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
            <?php if(isset($_SESSION['searchRequest'])) : ?>
                <a href="<?php echo site_url().'/Produits/resetSearch'?>"><button type='button' class= 'btn btn-primary'  value="Supprimer les filtres de recherches">Supprimer les filtres de recherche</button></a>
            <?php endif; ?>
        </nav>

        <div id="background"></div>

        <div class="container">
            <?php $this->load->view($content); ?>
        </div>

		<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/popper.js') ?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

        <script>
            document.getElementById('btnAjoutAdditif').addEventListener('click', ajouterAdditif);

            function ajouterAdditif(event){
                var additifsInput = document.getElementById('choixAdditif');
                var additifActuel = additifsInput.value;
                var additifsTable = document.getElementById('tableAdditif');
                var temps = Date.now();
                var tr = document.createElement('tr');
                tr.id = temps;
                tr.innerHTML = '<td>' + additifActuel + '</td>'+
                        '<td>' + '<button ' +
                        '\' type=\'button\' class=\'btn btn-primary\' value=\'Suppression\' ' +
                        'onclick=\'supprimerLigne('+ temps +')\'>-</button></td>' +
                        '<input type=\'hidden\' name=\'selectAdditif[]\' value=\'' + additifActuel +'\'>';
                additifsTable.appendChild(tr);
            }

            function supprimerLigne(id){
                document.getElementById(id).remove();
            }

            $(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
        </script>

    </body>
</html>
