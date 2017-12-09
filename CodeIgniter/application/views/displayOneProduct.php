<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
	<?php echo $product['product']['last_modified_t'] ?>
	<br><br>
	<?php echo substr($product['product']['last_modified_t'],0 ,19); ?>
	<br><br>
	<?php echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000)); ?>
	<br><br>
	<?php echo print_r($product) ?>
	<br><br>
	<?php echo print_r($product['additif']) ?>



	<h1><?php echo $product['product']['product_name']?></h1>
	<h2>caracteristiques :</h2>
	<table>
		<tr>
			<th>code : </th>
			<td><?php echo $product['product']['id_produit'] ?></td>
		</tr>
		<tr>
			<th>marque : </th>
			<td><?php echo $product['product']['brands'] ?></td>
		</tr>
		<tr>
			<th>portion : </th>
			<td><?php echo $product['product']['serving_size'] ?></td>
		</tr>
		<tr>
			<th>pays : </th>
			<td><?php echo $product['product']['countries_fr'] ?></td>
		</tr>
	</table>

	<h2>Additifs :</h2>
	<?php if(!empty($product['additif'])) :?>
		<table>
			<tr>
				<th>code</th>
				<th>nom</th>
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

	<h2>Composition :</h2>

	<h2>Nutrition :</h2>
	<table>
		<tr>
			<th>Valeur moyenne pour :</th>
			<th>100g</th>
		</tr>
		<tr>
			<td>energie</td>
			<td><?php echo $product['product']['energy_100g'] ?></td>
		</tr>
		<tr>
			<td>graisse</td>
			<td><?php echo $product['product']['fat_100g'] ?></td>
		</tr>
		<tr>
			<td>graisse saturée</td>
			<td><?php echo $product['product']['satured_fat_100g'] ?></td>
		</tr>
		<tr>
			<td>graisse trans</td>
			<td><?php echo $product['product']['trans_fat_100g'] ?></td>
		</tr>
		<tr>
			<td>cholesterol</td>
			<td><?php echo $product['product']['cholesterol_100g'] ?></td>
		</tr>
		<tr>
			<td>carbohydrates</td>
			<td><?php echo $product['product']['carbohydrates_100g'] ?></td>
		</tr>
		<tr>
			<td>sucres</td>
			<td><?php echo $product['product']['sugars_100g'] ?></td>
		</tr>
		<tr>
			<td>fibres</td>
			<td><?php echo $product['product']['fibers_100g'] ?></td>
		</tr>
		<tr>
			<td>protéines</td>
			<td><?php echo $product['product']['proteins_100g'] ?></td>
		</tr>
		<tr>
			<td>sel</td>
			<td><?php echo $product['product']['salt_100g'] ?></td>
		</tr>
		<tr>
			<td>sodium</td>
			<td><?php echo $product['product']['sodium_100g'] ?></td>
		</tr>
		<tr>
			<td>vitamine A</td>
			<td><?php echo $product['product']['vitamin_a_100g'] ?></td>
		</tr>
		<tr>
			<td>vitamine C</td>
			<td><?php echo $product['product']['vitamin_c_100g'] ?></td>
		</tr>
		<tr>
			<td>calcium</td>
			<td><?php echo $product['product']['calcium_100g'] ?></td>
		</tr>
		<tr>
			<td>fer</td>
			<td><?php echo $product['product']['iron_100g'] ?></td>
		</tr>
		<tr>
			<td>Score nutritif</td>
			<td><?php echo $product['product']['nutrition_score_fr_100g'] ?></td>
		</tr>
	</table>

	<h2>Nutri-score :</h2>
	<?php switch($product['product']['nutrition_grade_fr']){
		case 'a':
			echo "<img src=".base_url().'assets/image/nutriscore/A.png'." alt='nutriscore A'>";
			break;
		case 'b':
			echo "<img src=".base_url().'assets/image/nutriscore/B.png'." alt='nutriscore B'>";
			break;
		case 'c':
			echo "<img src=".base_url().'assets/image/nutriscore/C.png'." alt='nutriscore C'>";
			break;
		case 'd':
			echo "<img src=".base_url().'assets/image/nutriscore/D.png'." alt='nutriscore D'>";
			break;
		case 'e':
			echo "<img src=".base_url().'assets/image/nutriscore/E.png'." alt='nutriscore E'>";
			break;
		default:
			echo "<p>Nutri-score non renseigné</p>";
	} ?>



	<h2>Informations complementaires :</h2>
	<table>
			<?php if(empty($product['product']['contributeur'])){
				//Dans le cas d'une importation depuis un site tierce
				echo "</tr>";
				echo "<th>Importé depuis :</th>";
				echo "<td><a href=".$product['reference']['url'].">".$product['reference']['nom']."</a></td>";
				echo "</tr>";
			}else{
				//Dans le cas d'un contributeur enregistré sur le site
				echo "non importé";
			}
			?>

		<tr>
			<th>Date de création :</th>
			<td><?php echo substr($product['product']['created_t'],0 ,19); ?></td>
		</tr>
		<tr>
			<th>Date de derniere modification :</th>
			<td><?php echo substr($product['product']['last_modified_t'],0 ,19); ?></td>
		</tr>

	</table>
</html>
