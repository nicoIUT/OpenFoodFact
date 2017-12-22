<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('form');
$this->load->helper('url');
?>




<h1 class="display-3 mb-5">Création de produit </h1>
<?php echo form_open('Produits2/formRegisterProduct'); ?>
<div class="row">
	<div class="col">
	
		<h2>Caracteristiques</h2>
		<table class="table table-sm">
			<tr>
				<th>nom</th>
				<td><td><input type="text" name="nom"></td></td>
			</tr>
			<tr>
				<th>creer une Marque</th>
				<td><td><input type="text" name="marque" onclick="activer()"></td></td>
				<?php
					if(isset($message_erreur)) {
						echo '<p>'.$message_erreur.'</p>';
						}
				?>
				</tr>
				<tr>
				
			
				<th>selectionner une marque </th>
				<td><td>
			<select  disabled="true" size="10" style="width:12.65em ;" name = "listbrands">
					
					<?php foreach ($marques as $marque) : ?>
									<?php echo "<option value=".$marque['nom'].">".$marque['nom']."</option>"; ?>
								<?php endforeach; ?>
								
				</select>
			</td>	</td>	
			
    

			</tr>
			
			<tr>
				<th>Pays</th>
				<td><td><input type="text" name="pays"></td></td>
			</tr>
		</table>

		<h2>Nutri-score</h2>
		<label>
            <table class="table">
                <tr>
                    <td>
                        <input <?php if (isset($nutriscoreA) && $nutriscoreA=="a") echo "checked";?> type="radio" name="nutriscore" value="a">
                    </td>
                    <td>
					
                        <input  <?php if (isset($nutriscoreB) && $nutriscoreB=="b") echo "checked";?>type="radio" name="nutriscore" value="b">
                    </td>
                    <td>
                        <input  <?php if (isset($nutriscoreC) && $nutriscoreC=="c") echo "checked";?> type="radio"  name="nutriscore" value="c">
                    </td>
                    <td>
                        <input  <?php if (isset($nutriscoreD) && $nutriscoreD=="d") echo "checked";?>type="radio" name="nutriscore" value="d">
                    </td>
                    <td>
                        <input  <?php if (isset($nutriscoreE) && $nutriscoreE=="e") echo "checked";?>type="radio" name="nutriscore" value="e">
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
				<td><input type="text" name="Id_additif"></td>
			</tr>
			</tr>
				
		<h2>Ingredients</h2>
		
	</div>
	<div class="col">
	
         <table class="table">
		<h2>Nutrition</h2>
			<h4>Valeur moyenne pour 100</h4>
			<tr>
				<th>Energie</th>
				<td><td><input type="number" name="energie"></td></td>
				<th>(en KJ ) </th>
			</tr>
           
				<th>Graisse	</th>
				<td><td><input type="number" name="graisse"></td></td>
				<th>(en g) </th>
			</tr>
            	
				<th>Graisse saturée	</th>
				<td><td><input type="number" name="graisseSaturee"></td></td>
				<th>(en g) </th>
			</tr>
            	
				<th>Graisse trans</th>
				<td><td>	<input type="number" name="graisseTrans"></td></td>
				<th>(en g) </th>
			</tr>
            <tr>	
				<th>Cholesterol	</th>
				<td><td><input type="number" name="cholesterol"></td></td></br>
				<th>(en g) </th>
			</tr>
            <tr>	
				<<th>Carbohydrates	</th>
				<td><td><input type="number" name="carbohydrates"></td></td>
				<th>(en g) </th>
			</tr>
            <tr>	
				<th>Sucres	</th>
				<td><td><input type="number" name="sucre"></td></td>
				<th>(en g) </th>
			</tr>
            <tr>	
				<th>Fibres	</th>
				<td><td><input type="number" name="fibre"></td></td>
				<th>(en g) </th>
			</tr>
            <tr>	
				<th>Protéines	</th>
				<td><td><input type="number" name="proteine"></td></td>
				<th>(en g) </th>
			</tr>
            <tr>	
				<th>Sel	</th>
				<td><td><input type="number" name="sel"></td></td>
				<th>(en g) </th>
			</tr>
			
            <tr>	
				<th>Sodium	</th>
				<td><td><input type="number" name="sodium"></td></td>
				<th>(en g) </th>
			</tr>
            <tr>	
				<th>Vitamine A	</th>
				<td><td><input type="number" name="vitamineA"></td></td>
				<th>(en g) </th>
			</tr>
            <tr>	
				<th>Vitamine C	</th>
				<td><td><input type="number" name="vitamineC"></td></td>
				<th>(en g) </th>
			</tr>
            <tr>	
				<th>Calcium	</th>
				<td><td><input type="number" name="calcium"></td></td>
				<th>(en g) </th>
			</tr>
            <tr>	
				<th>Fer	</th>
				<td><td><input type="number" name="fer"></td></td>
				<th>(en g) </th>
			</tr>   
		</table>
	</div>
</div>


<h2>Informations complementaires</h2>
	<td> si besoin donner un site source ( lien ) 	</td>
	<td><input type="number" name="scoreNutritif"></td>
			
		</tr></br>

</table>
<button type='submit' class='btn btn-primary btn-block'  value="Rechercher">creer le produit </button>
</form>

</form>
