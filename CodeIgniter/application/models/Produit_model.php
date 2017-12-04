<?php
class  Data_model  extends  CI_Model {
	public  function  __construct ()
	{
		$this->load->database ();
		$this->load->library('session');
	}

	
	public function data_get_Produit_nom($nom_produit) 
	{
		$this->db->select('');
		$this->db->from('_Produit');
		$this->db->where(array('product_name' => $nom_marque )) ;
		
		$query = $this->db->get(); 
		$rep =  $query ->result_array();
		return  $rep ; 
	
	}
	
	public function data_get_Produit_marque($nom_marque) 
	{
		$this->db->select('product_name');
		$this->db->from('_Produit');
		$this->db->where(array('brands' => $nom_marque )) ; 
		
		$query = $this->db->get(); 
		$rep =  $query ->result_array();
		return  $rep ; 
	
	}
	
	public function data_get_Produit_code($id_produit) 
	{
		$this->db->select('product_name');
		$this->db->from('_Produit');
		$this->db->where(array('id_produit' => $id_produit )) ; 
		
		$query = $this->db->get(); 
		$rep =  $query ->result_array();
		return  $rep ; 
	
	}
	
	
	public fonction data_get_Produit_ingredients( $liste ) {
	
		$this->db->select('product_name');
		
		/*a ecrire 
		 * 
		 *  select nom_produit from 
		 * ( produit inner join "contenu_produit" on (id = id) ) 
		 * inner join Ingredient on ( id = id ) 
		 * where Ingredient in ( select nom from ingredient where nom in ( $data[0]....[n] )
		 * 
		 * 
	



}
