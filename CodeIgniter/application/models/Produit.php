<?php
class  Produit  extends  CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
	}

	//Recupere les ingredient contenu dans les autres ingredient (par recursivité)
	public function getIngredientList($id, &$ingredientCollector){
		if(array_key_exists($id, $ingredientCollector)){
			return;
		}
		$list_ing = $this->db->query("SELECT *
                                    FROM openfoodfacts._ingredientcontenusingredient
                                    INNER JOIN openfoodfacts._ingredient
                                    ON openfoodfacts._ingredientcontenusingredient.id_ingredient_contenu = openfoodfacts._ingredient.id_ingredient
                                    WHERE id_ingredient_contenant = '$id'")->result_array();
		if(!empty($list_ing)){
			foreach($list_ing as $ing){
				$this->getIngredientList($ing['id_ingredient_contenu'], $ingredientCollector);
				$ingredientCollector[$id][] = $ing;
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

		//Pays dans lesquels sont commercialisé l'ingredient
        $result['pays'] = $this->db->query("SELECT pays
                                          FROM openfoodfacts._produit INNER JOIN openfoodfacts._payscommercialiseproduit
                                          ON openfoodfacts._produit.id_produit = openfoodfacts._payscommercialiseproduit.id_produit
                                          WHERE openfoodfacts._payscommercialiseproduit.id_produit = $id")->result_array();


        //Ingredients contenus dans le produit si celui ci a été importé (sous forme de texte)
        $result['ingredient_text'] = $this->db->query("SELECT *
                                    FROM openfoodfacts._ingredientTexte
                                    WHERE id_produit = $id")->row_array();



		//Ingredients contenus dans le produit
		$result['ingredient'] = array();
		$list_ing = array();
		$list_ing = $this->db->query("SELECT openfoodfacts._ingredientcontenusproduit.id_ingredient, ingredients_text
                                    FROM openfoodfacts._ingredientcontenusproduit
                                    INNER JOIN openfoodfacts._ingredient
                                    ON openfoodfacts._ingredientcontenusproduit.id_ingredient = openfoodfacts._ingredient.id_ingredient
                                    WHERE id_produit = $id")->result_array();
		if(!empty($list_ing)){
			foreach($list_ing as $ing){
				$result['firstRankIngredient'][] = $ing;
				$this->getIngredientList($ing['id_ingredient'], $result['ingredient']);
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

    //Gere l'affichage de la liste des produits
    public function getProductList($page, $nbProduct, $productName =''){
	    //$page > page désirée
        //$nbProduct > nombre de produit affiché sur la page
        //$productName > filtre sur le nom de produit

	    $result = array();

	    //$result['list'] renvoie une partie de la base ($nbproduit)
	    $result['list'] = $this->db->query("SELECT id_produit, product_name, brands
	                            FROM openfoodfacts._produit
	                            WHERE UPPER(product_name) LIKE UPPER('%$productName%')
	                            ORDER BY id_produit 
	                            LIMIT $nbProduct OFFSET $page*$nbProduct")->result_array();

	    //$result['count'] est le nombre de produit total de la base
	    $result['count'] = $this->db->query("SELECT count(*) count
                                            FROM openfoodfacts._produit
                                            WHERE UPPER(product_name) LIKE UPPER('%$productName%')")->row_array();

        return $result;
    }

    public function getAdditif(){
        return $this->db->query("SELECT * FROM openfoodfacts._additif")->result_array();
    }

    public function getMarque(){
        return $this->db->query("SELECT * FROM openfoodfacts._marque")->result_array();
    }

    public function advancedResearchQuery($request){
		return $this->db->query($request)->result_array();
	}

	public function getSearchList($page, $nbProduct){
		$result = array();

		$result['list'] = $this->db->query("WITH fullRequest AS (".($_SESSION['searchRequest']).")
											SELECT * FROM fullRequest
											ORDER BY id_produit
											LIMIT $nbProduct OFFSET $page*$nbProduct")->result_array();

		$result['count'] = $this->db->query("WITH fullRequest AS (".($_SESSION['searchRequest']).")
											SELECT count(*) count
											FROM fullRequest ")->row_array();

		return $result;
	}

	public function updateProduct($request){
        return $this->db->query($request);
    }

    public function resetAdd($id){
        $this->db->query("DELETE FROM openfoodfacts._additifcontenus WHERE id_produit = $id");
    }

    public function addAdd($idP, $idA){
        $this->db->query("INSERT INTO openfoodfacts._additifcontenus VALUES('$idA', $idP)");
    }

    public function resetIng($id){
        //IngredientText
        $this->db->query("DELETE FROM openfoodfacts._ingredienttexte WHERE id_produit= $id");

        //IngredientTree
    }

    public function getIngredients($id){
        $result = array();

        $result['ingredient_text'] = $this->db->query("SELECT *
                                    FROM openfoodfacts._ingredientTexte
                                    WHERE id_produit = $id")->row_array();


        return $result;
    }

    public function getPays($id){
        return $this->db->query("SELECT pays FROM openfoodfacts._payscommercialiseproduit WHERE id_produit = $id")->result_array();
    }

    public function resetPays($id){
        return $this->db->query("DELETE FROM openfoodfacts._payscommercialiseproduit WHERE id_produit = $id");
    }

    public function createPays($pays){
        if($this->db->query("SELECT * FROM openfoodfacts._pays WHERE nom = '$pays'")->row()==false) {
            $this->db->query("INSERT INTO openfoodfacts._pays VALUES('$pays')");
        }
    }

    public function assocPays($pays, $code){
        return $this->db->query("INSERT INTO openfoodfacts._payscommercialiseproduit VALUES($code, '$pays')");
    }
    
    public function getAllPays(){
		return $this->db->query("SELECT * FROM openfoodfacts._pays")->result_array();
	}

}
