<?php
class  Produit  extends  CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
	}

	public function getIngredientList($id, &$ingredientCollector){
		if(array_key_exists($id, $ingredientCollector)){
			return;
		}
		$list_ing = $this->db->query("SELECT * FROM openfoodfacts._ingredientcontenusingredient WHERE ingredients_contenant = '$id'")->result_array();
		if(!empty($list_ing)){
			foreach($list_ing as $ing){
				$this->getIngredientList($ing['ingredients_contenu'], $ingredientCollector);
				$ingredientCollector[$id][] = $ing['ingredients_contenu'];
			}
		}
	}



    public function getProductByID($id)
        //Retourne le produit dont l'id est passé en paramètre

    {

		$result = array();

		//Caractéristiques du produit affiché
		$result['product'] = $this->db->query("SELECT * FROM openfoodfacts._produit WHERE id_produit = $id")->row_array();

		//Additifs contenus dans le produit
		$list_add = array();
		$ids_add = $this->db->query("SELECT * FROM openfoodfacts._additifcontenus WHERE id_produit = $id")->result_array();
		if(!empty($ids_add)){
			foreach ($ids_add as $id_add){
				$list_add[] = $this->db->query("SELECT * FROM openfoodfacts._additif WHERE id_additif = '$id_add[id_additif]'")->row_array();
			}
		}
		$result['additif'] = $list_add;

		//Ingredients contenus dans le produit
		$result['ingredient'] = array();
		$list_ing = array();
		$list_ing = $this->db->query("SELECT * FROM openfoodfacts._ingredientcontenusproduit WHERE id_produit = $id")->result_array();
		if(!empty($list_ing)){
			foreach($list_ing as $ing){
				$result['firstRankIngredient'][] = $ing['ingredients_text'];
				$this->getIngredientList($ing['ingredients_text'], $result['ingredient']);
			}
		}


		//Reference du produit (importation)
		$result['reference'] = $this->db->query("SELECT openfoodfacts._reference.url, openfoodfacts._reference.nom
												FROM openfoodfacts._produit
												INNER JOIN openfoodfacts._reference
												ON openfoodfacts._produit.id_produit = openfoodfacts._reference.id_reference
												WHERE openfoodfacts._produit.id_produit = $id")->row_array();

		//Contributeur du produit (ajout)
		$result['contributeur'] = $this->db->query("SELECT *
												FROM openfoodfacts._produit
												INNER JOIN openfoodfacts._contributeur
												ON openfoodfacts._produit.id_produit = openfoodfacts._contributeur.id_compte
												WHERE openfoodfacts._produit.id_produit = $id")->row_array();


        return $result;
    }

}
