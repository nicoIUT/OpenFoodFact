<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


<div class="row">
	<div class="col">
		
		<h2>Caracteristiques</h2>
		<table class="table table-sm">
			<tr>
				<th>nom</th>
				<td><td><input type="text" name="nom"></td></td>
			</tr>
				<th>Marque</th>
				<td><td><input type="text" name="marque"></td></td>
			</tr>
			
			<tr>
				<th>Pays</th>
				<td><input type="text" name="pays"></td>
			</tr>
		</table>

		<h2>Nutri-score</h2>
		<label>
            <table class="table">
                <tr>
                    <td>
                        <input type="checkbox" name="nutriscoreA" value="a">
                    </td>
                    <td>
                        <input type="checkbox" name="nutriscoreB" value="b">
                    </td>
                    <td>
                        <input type="checkbox"  name="nutriscoreC" value="c">
                    </td>
                    <td>
                        <input type="checkbox" name="nutriscoreD" value="d">
                    </td>
                    <td>
                        <input type="checkbox" name="nutriscoreE" value="e">
                    </td>
                </tr>
                <tr>
                    <td>
                        A
                    </td>
                    <td>
                        B
                    </td>
                    <td>
                       C
                    </td>
                    <td>
                        D
                    </td>
                    <td>
                        E
                    </td>
                </tr>
            </table>
        </label>

		<h2>Additifs</h2>
			<tr>
				<th>choisir un ou plusieurs adittifs dans la liste</th>
				<table id="tableAdditif" class="table table-sm">
					<tr>
						<th>Code</th>
						<th></th>
					</tr>
					<tr>
						<td>
							<input list="listAdditif" type="text" id="choixAdditif">
							<datalist id="listAdditif">
								<?php foreach ($additifs as $additif) : ?>
									<?php echo "<option value=".$additif['id_additif'].">".$additif['nom']."</option>"; ?>
								<?php endforeach; ?>
							</datalist>
						</td>
						<td>
							<button id='btnAjoutAdditif' type='button' class='btn btn-primary'  value="Ajout">+</button>
						</td>
					</tr>
	        </table>
			</tr>
				
			<tr>
				<th> creer un additif : </th>
				<tr>
				<td>nom : </td>
				<td><input type="text" name="additif_nom"></td>
			</tr>
            <tr>
				<td> Code</td>
				<td><input type="number" name="Id_additif"></td>
			</tr>
			</tr>
				
		<h2>Ingredients</h2>
		
	</div>
	<div class="col">
		<h2>Nutrition</h2>
		
			<tr>
				<th>Valeur moyenne pour</th>
				<th>100g</th>
			</tr>
			<tr>
				<td>Energie</td>
				<td><input type="number" name="energie"></td>
			</tr>
            <tr>
				<td>Graisse</td>
				<td><input type="number" name="graisse"></td>
			</tr>
            <tr>	
				<td>Graisse saturée</td>
				<td><input type="number" name="graisseSaturee"></td>
			</tr>
            <tr>	
				<td>Graisse trans</td>
				<td><input type="number" name="graisseTrans"></td>
			</tr>
            <tr>	
				<td>Cholesterol</td>
				<td><input type="number" name="cholesterol"></td>
			</tr>
            <tr>	
				<td>Carbohydrates</td>
				<td><input type="number" name="carbohydrates"></td>
			</tr>
            <tr>	
				<td>Sucres</td>
				<td><input type="number" name="sucre"></td>
			</tr>
            <tr>	
				<td>Fibres</td>
				<td><input type="number" name="fibre"></td>
			</tr>
            <tr>	
				<td>Protéines</td>
				<td><input type="number" name="proteine"></td>
			</tr>
            <tr>	
				<td>Sel</td>
				<td><input type="number" name="sel"></td>
			</tr>
            <tr>	
				<td>Sodium</td>
				<td><input type="number" name="sodium"></td>
			</tr>
            <tr>	
				<td>Vitamine A</td>
				<td><input type="number" name="vitamineA"></td>
			</tr>
            <tr>	
				<td>Vitamine C</td>
                <td><input type="number" name="vitamineC"></td>
			</tr>
            <tr>	
				<td>Calcium</td>
                <td><input type="number" name="calcium"></td>
			</tr>
            <tr>	
				<td>Fer</td>
                <td><input type="number" name="fer"></td>
			</tr>
            <tr>	
				<td>Score nutritif</td>
				<td><input type="number" name="scoreNutritif"></td>
                
			</tr>
		</table>
	</div>
</div>


<h2>Informations complementaires</h2>
	<td> si besoin donner un site source ( lien ) 	</td>
	<td><input type="number" name="scoreNutritif"></td>
			<th>Date de création</th>
		
			<th>Date de derniere modification</th>
		</tr>

</table>

