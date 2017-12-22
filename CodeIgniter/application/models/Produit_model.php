<?php
class  Produit_model  extends  CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');

    }


	public function getVerifByName($name){
		
		$rep = true ; 
		
		$listname = $this->db->query(" select product_name FROM openfoodfacts._produit WHERE product_name = '$name' ;") ; 
		// echo ( $listname['product_name'] ) ; 
		$num = $listname->num_rows();
		echo $num ;  
		if  ( $num > 0 ) {
			
			
			$rep =  false  ; 
		}
		 
	
		return $rep ;
	}
	public function getVerifByBrands($brand){
		
		$rep = true ; 
		
		$listbrand = $this->db->query(" select nom FROM openfoodfacts._marque WHERE  nom = '$brand' ;") ; 
		 
		$num = $listbrand->num_rows();
		echo $num ;  
		if  ( $num > 0 ) {
			
			
			$rep =  false  ; 
		}
		 
	
		return $rep ;
	}

	
	
}

	
	
