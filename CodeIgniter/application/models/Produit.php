<?php
class  Produit  extends  CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
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
				$list_add[] = $this->db->query("SELECT * FROM openfoodfacts._additif WHERE id_additif = '$id_add[id_additif]'")->result_array();
			}
		}	
		$result['additif'] = $list_add;
		
		//Ingredients contenus dans le produit
		//TODO
		//$result['ingredient'] = "";
		
		
		//Reference du produit (importation)
		$result['reference'] = $this->db->query("SELECT * FROM openfoodfacts._produit 
												INNER JOIN openfoodfacts._reference ON
												openfoodfacts._produit.id_produit = openfoodfacts._reference.id_reference
												WHERE openfoodfacts._produit.id_produit = $id")->result_array();
												
		//Contributeur du produit (ajout)
		$result['contributeur'] = $this->db->query("SELECT * FROM openfoodfacts._produit
												INNER JOIN openfoodfacts._contributeur 
												ON openfoodfacts._produit.id_produit = openfoodfacts._contributeur.id_compte
												WHERE openfoodfacts._produit.id_produit = $id")->result_array();
		
		
        return $result;
    }

}
