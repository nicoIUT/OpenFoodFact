<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('form');
$this->load->helper('url');
?>

<h1 class="display-3 mb-5">Modification du produit</h1>

<?php echo form_open('Produits/formUpdateProduct'); ?>
<div class="row">
    <div class="col">
        <h2>Caracteristiques</h2>
        <table>
            <tr>
                <th>Nom</th>
                <td><input type="text" name="nom" value="<?php echo $product['product']['product_name'] ?>"></td>
            </tr>
            <tr>
                <th>Code</th>
                <td><input type="number" name="coded" value="<?php echo $product['product']['id_produit'] ?>"  disabled  ></td>
                <input type="hidden" name="code" value="<?php echo $product['product']['id_produit'] ?>"
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
                <td><input type="text" name="pays"></td>
            </tr>
        </table>
        <h2>Nutri-score</h2>
        <label>
            <table class="table">
                <tr>
                    <td>
                        <input type="radio" name="nutriscore" value="a" <?php if($product['product']['nutrition_grade_fr'] == 'a'){echo "checked";}?> >
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="b" <?php if($product['product']['nutrition_grade_fr'] == 'b'){echo "checked";}?>>
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="c" <?php if($product['product']['nutrition_grade_fr'] == 'c'){echo "checked";}?>>
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="d" <?php if($product['product']['nutrition_grade_fr'] == 'd'){echo "checked";}?>>
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="e" <?php if($product['product']['nutrition_grade_fr'] == 'e'){echo "checked";}?>>
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
        <table class="table table-sm">
            <tr>
                <th>Ajouter</th>
                <th></th>
                <th><button type="button" class="btn btn-primary">+</button></th>
            </tr>
            <tr>
                <td><input type="text"></td>
                <td><button type="button" class="btn btn-primary">-</button></td>
                <td><button type="button" class="btn btn-primary">+</button></td>
            </tr>
            <tr>
                <td>&nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text"></td>
                <td><button type="button" class="btn btn-primary">-</button></td>
                <td><button type="button" class="btn btn-primary">+</button></td>
            </tr>
            <tr>
                <td>Ceci est un prototype</td>
            </tr>
        </table>
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
    <a href="<?php echo base_url()."index.php/Produits/display/".$product['product']['id_produit'];?>"><button type='button' class='btn btn-danger btn-lg'  value="Annuler">Annuler</button></a>
    <button type='submit' class='btn btn-primary btn-lg'  value="Valider">Valider</button>
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
            console.log(additifActuel);
            tr.innerHTML = '<td>' + additifActuel + '</td>' +
                '<td>' + '<button ' +
                '\' type=\'button\' class=\'btn btn-primary\' value=\'Suppression\' ' +
                'onclick=\'supprimerLigne(\"' + additifActuel + '\")\'>-</button></td>' +
                '<input type=\'hidden\' name=\'selectAdditif[]\' value=\'' + additifActuel + '\'>';
            additifsTable.appendChild(tr);
        }
    }

    function supprimerLigne(id){
        document.getElementById(id).remove();
    }
/*
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
*/
</script>
