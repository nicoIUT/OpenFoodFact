<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<h1>mettre quelque chose ici</h1>
<h3><?php echo $product['count']['count'];?></h3>
<h4><?php echo $nbPage ?></h4>
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

<?php if ($currentPage == 0) :?>
    <a href='#'><input type='button' value='Précédent' disabled/></a>
<?php else : ?>
    <a href='#'><input type='button' value='Précédent'/></a>
<?php endif; ?>
<?php echo $currentPage ?>
<?php if ($currentPage >= $nbPage-1) : ?>
    <a href='#'><input type='button' value='Suivant' disabled/></a>
<?php else : ?>
    <a href='#'><input type='button' value='Suivant'/></a>
<?php endif; ?>
