<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<h1>Liste des produits</h1>

<p style="text-align: right;">
    <?php if($currentNbProduct == 25) : ?>
        <a href='#'><input type='button' value='Afficher par 25' disabled/></a>
    <?php else : ?>
        <a href='<?php echo site_url()."/Produits/listProduct/0/25"."/".$search; ?>'><input type='button' value='Afficher par 25'/></a>
    <?php endif ?>
    <?php if($currentNbProduct == 50) : ?>
        <a href='#'><input type='button' value='Afficher par 50' disabled/></a>
    <?php else : ?>
        <a href='<?php echo site_url()."/Produits/listProduct/0/50"."/".$search; ?>'><input type='button' value='Afficher par 50'/></a>
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
       echo "<td><a href='$urlID'><input type='button' value='Consulter'/></a></td>";
       echo '</tr>';
    }?>
</table>

<p style="text-align: center;">
    <?php if(empty($product['list'])) : ?>
        <?php echo "Aucun produit à afficher"?>
    <?php else : ?>
        <?php if ($currentPage == 0) :?>
            <a href='#'><input type='button' value='Précédent' disabled/></a>
        <?php else : ?>
            <a href='<?php echo site_url()."/Produits/listProduct/".($currentPage-1)."/".$currentNbProduct."/".$search; ?>'><input type='button' value='Précédent'/></a>
        <?php endif; ?>
        <?php echo ($currentPage+1)." / ".($nbPage); ?>
        <?php if ($currentPage >= $nbPage-1) : ?>
            <a href='#'><input type='button' value='Suivant' disabled/></a>
        <?php else : ?>
            <a href='<?php echo site_url()."/Produits/listProduct/".($currentPage+1)."/".$currentNbProduct."/".$search; ?>'><input type='button' value='Suivant'/></a>
        <?php endif; ?>
    <?php endif; ?>
</p>