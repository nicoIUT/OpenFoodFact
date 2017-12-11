<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function ingredientTree($ingredient, $tree){
	echo $ingredient.'<br/>';
	if(!array_key_exists($ingredient, $tree)){
		return;
	}
	echo "<ul>";
	foreach ($tree[$ingredient] as $subIngredient){
		echo '<li>';
		ingredientTree($subIngredient, $tree);
		echo '</li>';
	}
	echo "</ul>";
}


?>

<h1 class="display-3 mb-5"><?php echo $product['product']['product_name']?></h1>

<div class="row">
	<div class="col">
		<h2>Caracteristiques</h2>
		<table class="table table-sm">
			<tr>
				<th>Code</th>
				<td><?php echo $product['product']['id_produit'] ?></td>
			</tr>
			<tr>
				<th>Marque</th>
				<td><?php echo $product['product']['brands'] ?></td>
			</tr>
			<tr>
				<th>Portion</th>
				<td><?php echo $product['product']['serving_size'] ?></td>
			</tr>
			<tr>
				<th>Pays</th>
				<td><?php echo $product['product']['countries_fr'] ?></td>
			</tr>
		</table>

		<h2>Nutri-score</h2>
		<?php switch($product['product']['nutrition_grade_fr']){
			case 'a':
				echo "<img src=\"".base_url()."assets/image/nutriscore/A.png\" alt='nutriscore A'/>";
				break;
			case 'b':
				echo "<img src=\"".base_url()."assets/image/nutriscore/B.png\" alt='nutriscore B'/>";
				break;
			case 'c':
				echo "<img src=\"".base_url()."assets/image/nutriscore/C.png\" alt='nutriscore C'/>";
				break;
			case 'd':
				echo "<img src=\"".base_url()."assets/image/nutriscore/D.png\" alt='nutriscore D'/>";
				break;
			case 'e':
				echo "<img src=\"".base_url()."assets/image/nutriscore/E.png\" alt='nutriscore E'/>";
				break;
			default:
				echo "<p>Nutri-score non renseigné</p>";
		} ?>

		<h2>Additifs</h2>
		<?php if(!empty($product['additif'])) :?>
			<table class="table table-striped table-sm">
				<tr>
					<th>Code</th>
					<th>Nom</th>
				</tr>

				<?php foreach($product['additif'] as $additif) : ?>
					<tr>
						<td><?php echo $additif['id_additif'] ?></td>
						<td><?php echo $additif['nom'] ?></td>
					</tr>
				<?php endforeach ?>
			</table>
		<?php else : ?>
			<p>Aucun additifs renseignés</p>
		<?php endif ?>

		<h2>Ingredients</h2>
		<?php if(!empty($product['ingredient'])) {
            foreach ($product['firstRankIngredient'] as $ingredient) {
                ingredientTree($ingredient, $product['ingredient']);
            }
        }else if(!empty($product['ingredient_text'])){
            echo $product['ingredient_text']['ingredient_text'];
		}else{
			echo "<p>Aucun ingrédients renseignés</p>";
		}
		?>
	</div>
	<div class="col">
		<h2>Nutrition</h2>
		<table class="table table-striped table-sm">
			<tr>
				<th>Valeur moyenne pour</th>
				<th>100g</th>
			</tr>
			<tr>
				<td>Energie</td>
				<td><?php echo $product['product']['energy_100g'] ?></td>
			</tr>
			<tr>
				<td>Graisse</td>
				<td><?php echo $product['product']['fat_100g'] ?></td>
			</tr>
			<tr>
				<td>Graisse saturée</td>
				<td><?php echo $product['product']['satured_fat_100g'] ?></td>
			</tr>
			<tr>
				<td>Graisse trans</td>
				<td><?php echo $product['product']['trans_fat_100g'] ?></td>
			</tr>
			<tr>
				<td>Cholesterol</td>
				<td><?php echo $product['product']['cholesterol_100g'] ?></td>
			</tr>
			<tr>
				<td>Carbohydrates</td>
				<td><?php echo $product['product']['carbohydrates_100g'] ?></td>
			</tr>
			<tr>
				<td>Sucres</td>
				<td><?php echo $product['product']['sugars_100g'] ?></td>
			</tr>
			<tr>
				<td>Fibres</td>
				<td><?php echo $product['product']['fibers_100g'] ?></td>
			</tr>
			<tr>
				<td>Protéines</td>
				<td><?php echo $product['product']['proteins_100g'] ?></td>
			</tr>
			<tr>
				<td>Sel</td>
				<td><?php echo $product['product']['salt_100g'] ?></td>
			</tr>
			<tr>
				<td>Sodium</td>
				<td><?php echo $product['product']['sodium_100g'] ?></td>
			</tr>
			<tr>
				<td>Vitamine A</td>
				<td><?php echo $product['product']['vitamin_a_100g'] ?></td>
			</tr>
			<tr>
				<td>Vitamine C</td>
				<td><?php echo $product['product']['vitamin_c_100g'] ?></td>
			</tr>
			<tr>
				<td>Calcium</td>
				<td><?php echo $product['product']['calcium_100g'] ?></td>
			</tr>
			<tr>
				<td>Fer</td>
				<td><?php echo $product['product']['iron_100g'] ?></td>
			</tr>
			<tr>
				<td>Score nutritif</td>
				<td><?php echo $product['product']['nutrition_score_fr_100g'] ?></td>
			</tr>
		</table>
	</div>
</div>


<h2>Informations complementaires</h2>
<table class="table table-sm">
		<?php if(empty($product['product']['contributeur'])){
			//Dans le cas d'une importation depuis un site tierce
			echo "</tr>";
			echo "<th>Importé depuis</th>";
			echo "<td><a href=".$product['reference']['url'].">".$product['reference']['nom']."</a></td>";
			echo "</tr>";
		}else{
			//Dans le cas d'un contributeur enregistré sur le site
			echo "non importé";
		}
		?>

	<tr>
		<th>Date de création</th>
		<td><?php echo substr($product['product']['created_t'],0 ,19); ?></td>
	</tr>
	<tr>
		<th>Date de derniere modification</th>
		<td><?php echo substr($product['product']['last_modified_t'],0 ,19); ?></td>
	</tr>

</table>

