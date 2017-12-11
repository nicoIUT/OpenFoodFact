<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<h1>Liste des produits</h1>
<p style="text-align: right;">
    <?php if($currentNbProduct == 25) : ?>
        <a href='#'><input type='button' value='Afficher par 25' disabled/></a>
    <?php else : ?>
        <a href='<?php echo site_url()."/Produits/listProduct/0/25"; ?>'><input type='button' value='Afficher par 25'/></a>
    <?php endif ?>
    <?php if($currentNbProduct == 50) : ?>
        <a href='#'><input type='button' value='Afficher par 50' disabled/></a>
    <?php else : ?>
        <a href='<?php echo site_url()."/Produits/listProduct/0/50"; ?>'><input type='button' value='Afficher par 50'/></a>
    <?php endif ?>
</p>

<table class="table table-striped table-sm">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Marque</th>
        <th></th>
    </tr>
    <?php foreach ($product['list'] as $product){
       $urlID = site_url()."/Produits/display/".$product['id_produit'];
       echo '<tr>';
       echo "<td>".$product['id_produit']."</td>";
       echo "<td>".$product['product_name']."</td>";
       echo "<td>".$product['brands']."</td>";
       echo "<td><a href='$urlID'><input type='button' value='Consulter'/></a></td>";
       echo '</tr>';
    }?>
</table>

<p style="text-align: center;">
    <?php if ($currentPage == 0) :?>
        <a href='#'><input type='button' value='Précédent' disabled/></a>
    <?php else : ?>
        <a href='<?php echo site_url()."/Produits/listProduct/".($currentPage-1)."/".$currentNbProduct; ?>'><input type='button' value='Précédent'/></a>
    <?php endif; ?>
    <?php echo ($currentPage+1)." / ".($nbPage); ?>
    <?php if ($currentPage >= $nbPage-1) : ?>
        <a href='#'><input type='button' value='Suivant' disabled/></a>
    <?php else : ?>
        <a href='<?php echo site_url()."/Produits/listProduct/".($currentPage+1)."/".$currentNbProduct; ?>'><input type='button' value='Suivant'/></a>
    <?php endif; ?>
</p>