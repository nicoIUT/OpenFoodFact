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

		if  ( $num > 0 ) {


			$rep =  false  ;
		}


		return $rep ;
	}
	public function getVerifByBrands($brand){

		$rep = true ;

		$listbrand = $this->db->query(" select nom FROM openfoodfacts._marque WHERE  nom = '$brand' ;") ;

		$num = $listbrand->num_rows();

		if  ( $num > 0 ) {


			$rep =  false  ;
		}


		return $rep ;
	}
public function recup_table( $table_name) {
  $query = 'select * from ' . $table_name . ';';

  $result = pg_query($query);

  $i = 0;
  echo '<html><body><table>';
  while ($i < pg_num_fields($result))
  {
  	echo '<tr><td>' . pg_field_name($result, $i) . "  " . pg_field_type($result,$i) ."\n". '</td></tr>';
  	$i = $i + 1;
  }
  echo '';
  $i = 0;


}


public function execute_creation ( $request , $name , $marque , $produits ) {
	
	$this->db->query ( "insert into openfoodfacts._marque ( nom ) values ('$marque') ; "); 

    $this->db->query($request);

    $id = $this->db->query ( "select id_produit from openfoodfacts._produit  where product_name = '$name'; ");
    
    $this->db->query ( "insert into openfoodfacts._ingredienttexte ( id_produit , ingredient_texte ) values ( $id , '$produits' ) ; ");

	echo ("coucou : ").$id ; 
     return $id ;
}

public function coucou () {

return  $this->db->query ("select * from openfoodfacts._produit where product_name ='farine';");


}

}
