<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('form');
$this->load->helper('url');


?>
<head>
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>


<h1 class="display-3 mb-5">Création de produit </h1>
<?php echo form_open('Produits2/formRegisterProduct'); ?>
<div class="row">
	<div class="col">

		<h2>Caracteristiques</h2>
		<table class="table table-sm" id ="tableCara" >
			<tr>
				<th>nom</th>
				<td><td><input type="text" name="nom"></td></td>
			</tr>
			<tr>
				<th>portion</th>
				<td><td><input type="text" name="portion"></td></td>
			</tr>
			<tr>

				<th>selectionner une marque </th>
				<td>
					<td>
						<input list="lesmarque" name ="lesmarque" >
						<datalist id = "lesmarque"  size="10" style="width:12.65em ;"  >
								<?php foreach ($marques as $marque) : ?>
									<?php echo "<option value=\"".$marque['nom']."\">".$marque['nom']."</option>"; ?>
								<?php endforeach; ?>

						</datalist>
					</td>
				</td>
				

			</tr>

			<tr>
                <th>Pays</th>
                <td>
					<td>
                <input list="ajoutPays" name ="ajoutPays" id="ajoutP" >
						
						<datalist id = "ajoutPays"  size="10" style="width:12.65em ;"  >
								<?php foreach ($payslist as $payss) : ?>
									<?php echo "<option value=\"".$payss['nom']."\">".$pays['nom']."</option>"; ?>
								<?php endforeach; ?>
								

						</datalist>
				<td><button id='btnAjoutPays' type='button' class='btn btn-primary'  value="Ajout" onclick=ajouterPays()>+</button></td>
				 <?php foreach($pays as $p) : ?>
						<tr id = '<?php echo $p['nom']; ?>'>
						<td></td>
						<td><?php echo $p['nom']; ?></td>
						<td><button type='button' class='btn btn-primary' value='Suppression' onclick=supprimerLigne(<?php echo "'".$p['nom']."'"; ?>)>-</button>
						<input type='hidden' name='listPays[]' value='<?php echo $p['nom']; ?>'></td>
						</tr>
				<?php endforeach ?>
						</td>
               </td>
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
										<td>
                        <input type="radio" name="nutriscore" value="f">
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
										<td>
                        pas de nutriscore......
                    </td>



                </tr>
            </table>
        </label>

		<h2>Additifs</h2>
			<tr>
				<th>choisir un ou plusieurs additifs dans la liste</th>
			<table id="tableAdditif" class="table table-sm">
            <tr>
                <th>NOM</th>
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
				<th> Créer un additif : </th>
				<br/>
				<tr>
				<td>Nom : </td>
				<td><input type="text" name="additif_nom"></td>
			</tr>
            <tr>
				<td> Code</td>
				<td><input type="text" name="Id_additif"></td>
			</tr>
			</tr>

		<h2>Ingredients</h2>
			<tr>
				<th> Ecrire les ingredients avec comme séparateur une virgule :  </th>
				<textarea name="ingredient_list" rows="4" cols="50" value =""></textarea>
			
			</tr>

	</div>
</div>

  <table class="table">
			 <h2>Nutrition</h2>
			<h4>Valeur moyenne pour 100 g </h4>
			<tr>
				<th> Energie </th>
					<td><td><input type="number" name="energie" ></td></td>
				<th>(en KJ ) </th>
			</tr>
			<tr>
				<th>Graisse	</th>
					<td><td><input type="number" name="graisse" ></td></td>
				<th>(en g) </th>
			</tr>
			<tr>
				<th>Graisse saturée	</th>
					<td><td><input type="number" name="graisseSaturee" ></td></td>
				<th>(en g) </th>
			</tr>
			<tr>
				<th>Graisse trans</th>
					<td><td>	<input type="number" name="graisseTrans" ></td></td>
				<th>(en g) </th>
			</tr>
      <tr>
				<th>Cholesterol	</th>
					<td><td><input type="number" name="cholesterol" ></td></td>
				<th>(en g) </th>
			</tr>
      <tr>
				<th>Carbohydrates	</th>
					<td><td><input type="number" name="carbohydrates" ></td></td>
				<th>(en g) </th>
			</tr>
      <tr>
				<th>Sucres	</th>
					<td><td><input type="number" name="sucre" ></td></td>
				<th>(en g) </th>
			</tr>
      <tr>
				<th>Fibres	</th>
					<td><td><input type="number" name="fibre" ></td></td>
				<th>(en g) </th>
			</tr>
      <tr>
				<th>Protéines	</th>
					<td><td><input type="number" name="proteine" ></td></td>
				<th>(en g) </th>
			</tr>
      <tr>
				<th>Sel	</th>
					<td><td><input type="number" name="sel" ></td></td>
				<th>(en g)</th>
			</tr>
      <tr>
				<th>Sodium</th>
					<td><td><input type="number" name="sodium" ></td></td>
				<th>(en g)</th>
			</tr>
      <tr>
				<th>Vitamine A</th>
					<td><td><input type="number" name="vitamineA" ></td></td>
				<th>(en g) </th>
			</tr>
      <tr>
				<th>Vitamine C</th>
					<td><td><input type="number" name="vitamineC" ></td></td>
				<th>(en g) </th>
			</tr>
      <tr>
				<th>Calcium	</th>
					<td><td><input type="number" name="calcium" ></td></td>
				<th>(en g) </th>
			</tr>
      <tr>
				<th>Fer	</th>
					<td><td><input type="number" name="fer" ></td></td>
				<th>(en g) </th>
			</tr>
			<tr>
				<th>Score nutritif</th>
              <td> <td><input type="number" name="scoreNutritif"  ></td><td>
					</tr>

		</table>




<h2>Informations complementaires</h2>
	<td> si besoin donner un site source ( lien ) 	</td>
	<td><input type="text" name="liendemerde"></td>

		</tr>
</br>
</table>
<div class="row float-right">
    <button type='submit' class='btn btn-danger btn-lg'  value="Annuler">Annuler</button>
	</br>
    <button type='submit' class='btn btn-primary btn-lg'  value="Valider">creer le produit</button>
</div>
</form>



</script>

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
				function ajouterPays(event){
					console.log("42");
					var paysInput = document.getElementById('ajoutP');
					console.log("coucou");
					console.log(paysInput.value);
					if((document.getElementById(paysInput.value))===null){
							var paysActuel = paysInput.value;
							var paysTable = document.getElementById('tableCara');
							var tr = document.createElement('tr');
							tr.id = paysActuel;
							console.log(paysActuel);
							tr.innerHTML = '<td></td><td>' + paysActuel + '</td>' +
							'<td><button type\"button\" class=\"btn btn-primary\" value=\"Suppression\" onclick=\'supprimerLigne(\"'+ paysActuel +'\")\'>-</button></td>' +
							'<input type=\"hidden\" name=\"listPays[]\" value=\"'+ paysActuel +'\">';
							if ( paysActuel!="") {
							paysTable.appendChild(tr);
							}
					}
				}
				function supprimerLigne(id){
						document.getElementById(id).remove();
				}

				vals = [];

					
				

				$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
		</script>
