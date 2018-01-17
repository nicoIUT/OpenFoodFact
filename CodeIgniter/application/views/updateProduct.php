<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('form');
$this->load->helper('url');

?>



<h1 class="display-3 mb-5">Modification du produit</h1>

<?php echo form_open('Produits/formUpdateProduct', 'id=myForm'); ?>
<div class="row">
    <div class="col">
        <h2>Caracteristiques</h2>
        <table id="tableCara">
            <tr>
                <th>Nom</th>
                <td><input type="text" name="nom" value="<?php echo $product['product']['product_name'] ?>"></td>
            </tr>
            <tr>
                <th>Code</th>
                <td><input type="number" name="coded" value="<?php echo $product['product']['id_produit'] ?>"  disabled  ></td>
                <input type="hidden" name="code" value="<?php echo $product['product']['id_produit'] ?>">
            </tr>
            <tr>
                <th>Marque</th>
                <td>
                    <input list="listMarque" type="text" id="choixMarque" name="marque" value="<?php echo $product['product']['brands'] ?>">
                    <datalist id="listMarque">
                        <?php foreach ($marques as $marque) : ?>
                            <?php echo "<option value=\"".$marque['nom']."\"></option>"; ?>
                        <?php endforeach; ?>
                    </datalist>
                </td>
            </tr>
            <tr>
                <th>Portion</th>
                <td><input type="text" name="portion" value="<?php echo $product['product']['serving_size'] ?>"></td>
            </tr>
            <tr>
                <th>Pays</th>
                <td><input list="listPays" id='ajoutPays' type="text" name="pays"></td>
                    <datalist id="listPays">
                    <?php foreach ($allPays as $paysData) : ?>
						<?php echo "<option id=\"c".$paysData['nom']."\" value=\"".$paysData['nom']."\"></option>"; ?>
                    <?php endforeach; ?>
                </datalist>
                <td><button id='btnAjoutPays' type='button' class='btn btn-primary'  value="Ajout" onclick=ajouterPays()>+</button></td>
                <?php foreach($pays as $p) : ?>
                    <tr id = '<?php echo $p['pays']; ?>'>
                        <td></td>
                        <td><?php echo $p['pays']; ?></td>
                        <td><button type='button' class='btn btn-primary' value='Suppression' onclick=supprimerLigne(<?php echo "'".$p['pays']."'"; ?>)>-</button>
                            <input type='hidden' name='listPays[]' value='<?php echo $p['pays']; ?>'></td>
                    </tr>
                <?php endforeach ?>
            </tr>
        </table>
        <h2>Nutri-score</h2>
        <label>
            <table class="table">
                <?php $check=false; ?>
                <tr>
                    <td>
                        <input type="radio" name="nutriscore" value="a" <?php if($product['product']['nutrition_grade_fr'] == 'a'){echo "checked";$check=true;}?> >
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="b" <?php if($product['product']['nutrition_grade_fr'] == 'b'){echo "checked";$check=true;}?>>
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="c" <?php if($product['product']['nutrition_grade_fr'] == 'c'){echo "checked";$check=true;}?>>
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="d" <?php if($product['product']['nutrition_grade_fr'] == 'd'){echo "checked";$check=true;}?>>
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="e" <?php if($product['product']['nutrition_grade_fr'] == 'e'){echo "checked";$check=true;}?>>
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="f" <?php if($check == false){echo "checked";}?>>
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
                        Non renseigné
                    </td>
                </tr>
            </table>
        </label>
        <h2>Additifs</h2>
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
                            <?php echo "<option id=c".$additif['id_additif']." value=".$additif['id_additif'].">".$additif['nom']."</option>"; ?>
                        <?php endforeach; ?>
                    </datalist>
                </td>
                <td>
                    <button id='btnAjoutAdditif' type='button' class='btn btn-primary'  value="Ajout">+</button>
                </td>
            </tr>
            <?php foreach($product['additif'] as $additif) : ?>
                <tr id = '<?php echo $additif['id_additif']; ?>'>
                    <td><?php echo $additif['id_additif']; ?></td>
                    <td><button type='button' class='btn btn-primary' value='Suppression' onclick=supprimerLigne(<?php echo "'".$additif['id_additif']."'"; ?>)>-</button>
                        <input type='hidden' name='selectAdditif[]' value='<?php echo $additif['id_additif']; ?>'></td>
                </tr>
            <?php endforeach ?>

        </table>
        <h2>Ingredients</h2>
        <button type="button" class="btn btn-primary" onclick=displayIngText()>Texte</button>
        <button type="button" class="btn btn-primary" onclick=displayIngTree() >Arbre</button>
        <div id="ingredient">
            <!--Affichage des deux methodes de gestion des ingredients-->
        </div>
    </div>
    <div class="col">
        <h2>Nutrition</h2>
        <table class="table table-striped table-sm">
            <tr>
                <th>Valeur moyenne pour</th>
                <th>100g</th>
                <th></th>
            </tr>
            <tr>
                <td>Energie</td>
                <td><input type="number" name="energie" value="<?php echo $product['product']['energy_100g'] ?>"></td>
                <td>kj</td>
            </tr>
            <tr>
                <td>Graisse</td>
                <td><input type="number" name="graisse" value="<?php echo $product['product']['fat_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Graisse saturée</td>
                <td><input type="number" name="graisseSaturee" value="<?php echo $product['product']['satured_fat_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Graisse trans</td>
                <td><input type="number" name="graisseTrans" value="<?php echo $product['product']['trans_fat_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Cholesterol</td>
                <td><input type="number" name="cholesterol" value="<?php echo $product['product']['cholesterol_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Carbohydrates</td>
                <td><input type="number" name="carbohydrates" value="<?php echo $product['product']['carbohydrates_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Sucres</td>
                <td><input type="number" name="sucre" value="<?php echo $product['product']['sugars_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Fibres</td>
                <td><input type="number" name="fibre" value="<?php echo $product['product']['fibers_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Protéines</td>
                <td><input type="number" name="proteine" value="<?php echo $product['product']['proteins_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Sel</td>
                <td><input type="number" name="sel" value="<?php echo $product['product']['salt_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Sodium</td>
                <td><input type="number" name="sodium" value="<?php echo $product['product']['sodium_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Vitamine A</td>
                <td><input type="number" name="vitamineA" value="<?php echo $product['product']['vitamin_a_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Vitamine C</td>
                <td><input type="number" name="vitamineC" value="<?php echo $product['product']['vitamin_c_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Calcium</td>
                <td><input type="number" name="calcium" value="<?php echo $product['product']['calcium_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Fer</td>
                <td><input type="number" name="fer" value="<?php echo $product['product']['iron_100g'] ?>"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Score nutritif</td>
                <td><input type="number" name="scoreNutritif" value="<?php echo $product['product']['nutrition_score_fr_100g'] ?>"></td>
                <td>g</td>
            </tr>
        </table>
    </div>
</div>
<div class="row float-right">
    <button type="button" onclick="confirmCancel()" class='btn btn-danger btn-lg'>Annuler</button>
    <button type="button" onclick="confirmForm()" class='btn btn-primary btn-lg'>Valider</button>
</div>
</form>


<script>
    document.getElementById('btnAjoutAdditif').addEventListener('click', ajouterAdditif);

    function ajouterAdditif(event) {
        var additifsInput = document.getElementById('choixAdditif');
        if ((document.getElementById(additifsInput.value))===null && (document.getElementById('c'+additifsInput.value))!== null) {
            var additifActuel = additifsInput.value;
            var additifsTable = document.getElementById('tableAdditif');
            var tr = document.createElement('tr');
            tr.id = additifActuel;
            tr.innerHTML = '<td>' + additifActuel + '</td>' +
                '<td>' + '<button ' +
                '\' type=\'button\' class=\'btn btn-primary\' value=\'Suppression\' ' +
                'onclick=\'supprimerLigne(\"' + additifActuel + '\")\'>-</button></td>' +
                '<input type=\'hidden\' name=\'selectAdditif[]\' value=\'' + additifActuel + '\'>';
            additifsTable.appendChild(tr);
        }
    }

    function ajouterPays(event){
        var paysInput = document.getElementById('ajoutPays');
        console.log(paysInput.value);
        if(((document.getElementById(paysInput.value))===null) && ((document.getElementById('c'+paysInput.value))!== null)){
            var paysActuel = paysInput.value;
            var paysTable = document.getElementById('tableCara');
            var tr = document.createElement('tr');
            tr.id = paysActuel;
            console.log("42");
            tr.innerHTML = '<td></td><td>' + paysActuel + '</td>' +
                    '<td><button type\"button\" class=\"btn btn-primary\" value=\"Suppression\" onclick=\'supprimerLigne(\"'+ paysActuel +'\")\'>-</button></td>' +
                    '<input type=\"hidden\" name=\"listPays[]\" value=\"'+ paysActuel +'\">';
            paysTable.appendChild(tr);
        }
    }

    function supprimerLigne(id){
        document.getElementById(id).remove();
    }

    function displayIngText(){
        var container = document.getElementById('ingredient');
        container.innerHTML = "<textarea name=\"ingredientText\" cols=\"50\" rows=\"6\" style=\"background-color:rgba(0,0,0,.05);\"><?php echo $ingredients['ingredient_text']['ingredient_text'] ?></textarea>";

    }

    function displayIngTree(){
        var container = document.getElementById('ingredient');
        container.innerHTML ="<table class=\"table table-sm\">\n" +
            "                <tr>\n" +
            "                    <th>Ajouter</th>\n" +
            "                    <th></th>\n" +
            "                    <th><button type=\"button\" class=\"btn btn-primary\">+</button></th>\n" +
            "                </tr>\n" +
            "                <tr>\n" +
            "                    <td><input type=\"text\"></td>\n" +
            "                    <td><button type=\"button\" class=\"btn btn-primary\">-</button></td>\n" +
            "                    <td><button type=\"button\" class=\"btn btn-primary\">+</button></td>\n" +
            "                </tr>\n" +
            "                <tr>\n" +
            "                    <td>&nbsp;\n" +
            "                        &nbsp;\n" +
            "                        &nbsp;\n" +
            "                        &nbsp;\n" +
            "                        <input type=\"text\"></td>\n" +
            "                    <td><button type=\"button\" class=\"btn btn-primary\">-</button></td>\n" +
            "                    <td><button type=\"button\" class=\"btn btn-primary\">+</button></td>\n" +
            "                </tr>\n" +
            "                <tr>\n" +
            "                    <td>Ceci est un prototype</td>\n" +
            "                </tr>\n" +
            "            </table>";
    }
    
    function confirmForm(){
		var answer;
		answer = confirm("Confirmez vous les modification ?");
		if(answer === true){
			var form;
			form = document.getElementById("myForm");
			form.submit();
		}else{
			
		}
	}
	
	function confirmCancel(){
		var answer;
		answer = confirm("Etes vous sur de vouloir annuler ?");
		if(answer === true){
			window.location.replace(<?php echo "'".site_url()."/Produits/display/".$product['product']['id_produit']."'"; ?>);
		}else{
			
		}
	}



/*
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
*/
</script>

<?php if(!empty($ingredients['ingredient_text']['ingredient_text'])) :?>
    <script>displayIngText();</script>
<?php else : ?>
    <script>displayIngTree();</script>
<?php endif; ?>
