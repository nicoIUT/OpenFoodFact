<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<h1 class="display-3 mb-5">Liste des produits</h1>

<!--Boutons de nombre de produit / page-->
<p style="text-align: right;">
    <?php if($currentNbProduct == 25) : ?>
        <a href='#'><button type='button' class= 'btn btn-primary' value='Afficher par 25' disabled>Afficher par 25</button></a>
    <?php else : ?>
        <a href='<?php echo site_url()."/Produits/listProduct/0/25"."/".$search; ?>'><button type='button' class= 'btn btn-primary'  value='Afficher par 25'>Afficher par 25</button></a>
    <?php endif ?>
    <?php if($currentNbProduct == 50) : ?>
        <a href='#'><button type='button' class= 'btn btn-primary'  value='Afficher par 50' disabled>Afficher par 50</button></a>
    <?php else : ?>
        <a href='<?php echo site_url()."/Produits/listProduct/0/50"."/".$search; ?>'><button type='button' class= 'btn btn-primary'  value='Afficher par 50'>Afficher par 50</button></a>
    <?php endif ?>
</p>

<table class="table table-striped table-sm">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Marque</th>
        <th></th>
    </tr>
    <?php foreach ($product['list'] as $prod){
       $urlID = site_url()."/Produits/display/".$prod['id_produit'];
       echo '<tr>';
       echo "<td>".$prod['id_produit']."</td>";
       echo "<td>".$prod['product_name']."</td>";
       echo "<td>".$prod['brands']."</td>";
       echo "<td><a href='$urlID'><button type='button' class= 'btn btn-primary'  value='Consulter'>Consulter</button></a></td>";
       echo '</tr>';
    }?>
</table>

<!--Boutons precedents / suivants-->
<p style="text-align: center;">
    <?php if(empty($product['list'])) : ?>
        <?php echo "Aucun produit à afficher"?>
    <?php else : ?>
        <?php if ($currentPage == 0) :?>
            <a href='#'><button type='button' class= 'btn btn-primary' value='Précédent' disabled>Précédent</button></a>
        <?php else : ?>
            <a href='<?php echo site_url()."/Produits/listProduct/".($currentPage-1)."/".$currentNbProduct."/".$search; ?>'><button type='button' class= 'btn btn-primary' value='Précédent'>Précédent</button></a>
        <?php endif; ?>
        <?php echo ($currentPage+1)." / ".($nbPage); ?>
        <?php if ($currentPage >= $nbPage-1) : ?>
            <a href='#'><button type='button' class= 'btn btn-primary' value='Suivant' disabled>Suivant</button></a>
        <?php else : ?>
            <a href='<?php echo site_url()."/Produits/listProduct/".($currentPage+1)."/".$currentNbProduct."/".$search; ?>'><button type='button' class= 'btn btn-primary' value='Suivant'>Suivant</button></a>
        <?php endif; ?>
    <?php endif; ?>
</p>