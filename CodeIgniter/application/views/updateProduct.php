<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1 class="display-3 mb-5">Modification du produit</h1>

<?php echo form_open('Produits/formUpdateProduct'); ?>
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
                <td><input type="number" name="code" value="42222" disabled></td>
            </tr>
            <tr>
                <th>Marque</th>
                <td>
                    <input list="listMarque" type="text" id="choixMarque" name="marque">
                    <datalist id="listMarque">
                        <?php foreach ($marques as $marque) : ?>
                            <?php echo "<option value=\"".$marque['nom']."\"></option>"; ?>
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
        <label>
            <table class="table">
                <tr>
                    <td>
                        <input type="radio" name="nutriscore" value="a">
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="b">
                    </td>
                    <td>
                        <input type="radio"  name="nutriscore" value="c">
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="d">
                    </td>
                    <td>
                        <input type="radio" name="nutriscore" value="e">
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
        <p>//TODO mais ca sera pas evident ca demande pas mal de reflexion suivant ce que veut la prof</p>
        <h2>Ingredients</h2>
        <p>//TODO ca aussi c'est tendu car y'a de l'affichage recursif a gerer .... mais avec un peu de JS ca doit etre faisable</p>
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
                <td><input type="number" name="energie"></td>
                <td>kj</td>
            </tr>
            <tr>
                <td>Graisse</td>
                <td><input type="number" name="graisse"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Graisse saturée</td>
                <td><input type="number" name="graisseSaturee"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Graisse trans</td>
                <td><input type="number" name="graisseTrans"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Cholesterol</td>
                <td><input type="number" name="cholesterol"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Carbohydrates</td>
                <td><input type="number" name="carbohydrates"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Sucres</td>
                <td><input type="number" name="sucre"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Fibres</td>
                <td><input type="number" name="fibre"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Protéines</td>
                <td><input type="number" name="proteine"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Sel</td>
                <td><input type="number" name="sel"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Sodium</td>
                <td><input type="number" name="sodium"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Vitamine A</td>
                <td><input type="number" name="vitamineA"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Vitamine C</td>
                <td><input type="number" name="vitamineC"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Calcium</td>
                <td><input type="number" name="calcium"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Fer</td>
                <td><input type="number" name="fer"></td>
                <td>g</td>
            </tr>
            <tr>
                <td>Score nutritif</td>
                <td><input type="number" name="scoreNutritif"></td>
                <td>g</td>
            </tr>
        </table>
    </div>
</div>
<div class="row float-right">
    <button type='submit' class='btn btn-danger btn-lg'  value="Annuler">Annuler</button>
    <button type='submit' class='btn btn-primary btn-lg'  value="Valider">Valider</button>
</div>
</form>
