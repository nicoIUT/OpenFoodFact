<?php
class  Data_model  extends  CI_Model {
	public  function  __construct ()
	{
		$this->load->database ();
		$this->load->library('session');

	}


	public function getIngredientList(&$ingredientCollector){
		if(array_key_exists($id, $ingredientCollector)){
			return;
		}
		$list_ing = $this->db->query("SELECT * FROM openfoodfacts._ingredientcontenusingredient ")->result_array();
		if(!empty($list_ing)){
			foreach($list_ing as $ing){
				$this->getIngredientList($ing['ingredients_contenu'], $ingredientCollector);
				$ingredientCollector[$id][] = $ing['ingredients_contenu'];
			}
		}
	}

	 public function get_Products_by_brands ($brands ){
	    $result = array();

	    $result['list'] = $this->db->query("SELECT id_produit, product_name, brands 
	                            FROM openfoodfacts._produit
	                            WHERE UPPER(brands) LIKE UPPER('%$brands%') 
	                            ")->result_array();

	    $result['count'] = $this->db->query("SELECT count(*) count 
                                            FROM openfoodfacts._produit
                                            WHERE UPPER(brands) LIKE UPPER('%brands%')")->row_array();

        return $result;
    }


	public function get_additifs (){
		$list_add = array();
			$ids_add = $this->db->query("SELECT * FROM openfoodfacts._additifcontenus ")-> result_array();
			if(!empty($ids_add)){
				foreach ($ids_add as $id_add){
					$list_add[] = $this->db->query("SELECT * FROM openfoodfacts._additif WHERE id_additif = '$	id_add[id_additif]'")->row_array();
				}
			}
		$result['additif'] = $list_add;

	}








	public function get_pays ($pays) {

		 $result['pays'] = $this->db->query("SELECT pays 
                                          FROM openfoodfacts._produit INNER JOIN openfoodfacts._payscommercialiseproduit ")->result_array();
		
	}
	
	
	
	

	
	