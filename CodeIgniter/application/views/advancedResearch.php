<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>



<h1 class="display-3 mb-5">Recherche avancée</h1>

<?php echo form_open('Produits/formAdvancedSearch'); ?>
<div class="row">
    <div class="col">
        <h2>Caracteristiques</h2>
        <table>
            <tr>
                <th>Nom</th>
                <td><input type="text" name="nom"></td>
            </tr>
            <tr>
                <th>Code</th>
                <td><input type="text" name="code"></td>
            </tr>
            <tr>
                <th>Marque</th>
                <td>
                    <input list="listMarque" type="text" id="choixMarque">
                    <datalist id="listMarque">
                        <?php foreach ($marques as $marque) : ?>
                            <?php echo "<option value=".$marque['nom']."></option>"; ?>
                        <?php endforeach; ?>
                    </datalist>
                </td>
            </tr>
            <tr>
                <th>Portion</th>
                <td><input type="text" name="portion"></td>
            </tr>
            <tr>
                <th>Pays</th>
                <td><input type="text" name="pays"></td>
            </tr>
        </table>

        <h2>Nutri-score</h2>
        <label class="custom-control custom-checkbox">
            <table class="table">
                <tr>
                    <td>
                        <input type="checkbox" value="nutriscoreA">
                    </td>
                    <td>
                        <input type="checkbox" value="nutriscoreB">
                    </td>
                    <td>
                        <input type="checkbox"  value="nutriscoreC">
                    </td>
                    <td>
                        <input type="checkbox" value="nutriscoreD">
                    </td>
                    <td>
                        <input type="checkbox" value="nutriscoreE">
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
        <table id="tableAdditif" class="table table-sm">
            <tr>
                <th>Code</th>
                <th>Nom</th>
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

        <h2>Ingredients</h2>
        <input type="text" name="ingredient">
        <p>Entrez les ingredients séparés par des virgules</p>
    </div>
    <div class="col">
        <h2>Nutrition</h2>
        <table class="table table-striped table-sm">
            <tr>
                <th>Valeur moyenne pour</th>
                <th>100g</th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>Energie</td>
                <td><input type="text" name="energie"></td>
                <td><input type="checkbox" value="supenergie">></td>
                <td><input type="checkbox" value="infenergie"><</td>
            </tr>
            <tr>
                <td>Graisse</td>
                <td><input type="text" name="graisse"></td>
                <td><input type="checkbox" value="supgraisse">></td>
                <td><input type="checkbox" value="infgraisse"><</td>
            </tr>
            <tr>
                <td>Graisse saturée</td>
                <td><input type="text" name="graisseSaturee"></td>
                <td><input type="checkbox" value="supgraisseSaturee">></td>
                <td><input type="checkbox" value="infgraisseSaturee"><</td>
            </tr>
            <tr>
                <td>Graisse trans</td>
                <td><input type="text" name="graisseTrans"></td>
                <td><input type="checkbox" value="supgraisseTrans">></td>
                <td><input type="checkbox" value="infgraisseTrans"><</td>
            </tr>
            <tr>
                <td>Cholesterol</td>
                <td><input type="text" name="cholesterol"></td>
                <td><input type="checkbox" value="supcholesterol">></td>
                <td><input type="checkbox" value="infcholesterol"><</td>
            </tr>
            <tr>
                <td>Carbohydrates</td>
                <td><input type="text" name="carbohydrates"></td>
                <td><input type="checkbox" value="supcarbohydrates">></td>
                <td><input type="checkbox" value="infcarbohydrates"><</td>
            </tr>
            <tr>
                <td>Sucres</td>
                <td><input type="text" name="sucre"></td>
                <td><input type="checkbox" value="supsucre">></td>
                <td><input type="checkbox" value="infsucre"><</td>
            </tr>
            <tr>
                <td>Fibres</td>
                <td><input type="text" name="fibre"></td>
                <td><input type="checkbox" value="supfibre">></td>
                <td><input type="checkbox" value="inffibre"><</td>
            </tr>
            <tr>
                <td>Protéines</td>
                <td><input type="text" name="proteine"></td>
                <td><input type="checkbox" value="supproteine">></td>
                <td><input type="checkbox" value="infproteine"><</td>
            </tr>
            <tr>
                <td>Sel</td>
                <td><input type="text" name="sel"></td>
                <td><input type="checkbox" value="supsel">></td>
                <td><input type="checkbox" value="infsel"><</td>
            </tr>
            <tr>
                <td>Sodium</td>
                <td><input type="text" name="sodium"></td>
                <td><input type="checkbox" value="supsodium">></td>
                <td><input type="checkbox" value="infsodium"><</td>
            </tr>
            <tr>
                <td>Vitamine A</td>
                <td><input type="text" name="vitamineA"></td>
                <td><input type="checkbox" value="supvitamineA">></td>
                <td><input type="checkbox" value="infvitamineA"><</td>
            </tr>
            <tr>
                <td>Vitamine C</td>
                <td><input type="text" name="vitamineC"></td>
                <td><input type="checkbox" value="supvitamineC">></td>
                <td><input type="checkbox" value="infvitamineC"><</td>
            </tr>
            <tr>
                <td>Calcium</td>
                <td><input type="text" name="calcium"></td>
                <td><input type="checkbox" value="supcalcium">></td>
                <td><input type="checkbox" value="infcalcium"><</td>
            </tr>
            <tr>
                <td>Fer</td>
                <td><input type="text" name="fer"></td>
                <td><input type="checkbox" value="supfer">></td>
                <td><input type="checkbox" value="inffer"><</td>
            </tr>
            <tr>
                <td>Score nutritif</td>
                <td><input type="text" name="scoreNutritif"></td>
                <td><input type="checkbox" value="supscoreNutritif">></td>
                <td><input type="checkbox" value="infscoreNutritif"><</td>
            </tr>
        </table>
    </div>
</div>
</form>