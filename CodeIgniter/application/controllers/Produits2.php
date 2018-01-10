<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produits2 extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('html');

        $this->load->library('session');

        $this->load->model('Produit');
        $this->load->model('Produit_model');
    }

    public function index(){
        $this->listProduct();
    }

    public function display($id){
        if(preg_match("#^[0-9]+$#", $id)){
            $data['title'] = 'Produit:'.$id;
            $data['content'] = 'displayOneProduct';
            $data['product'] = $this->Produit->getProductByID($id);

                $this->load->vars($data);
                $this->load->view('template');
            }else{
                show_404();
            }

    }

    //Fonction pour determiner le nombre de page necessaire
    public function nbPage($nbProduct, $productPerPage){
        $result = $nbProduct/$productPerPage;
        $result = intval($result);
        if($nbProduct % $productPerPage !=0){
            $result = $result+1;
        }
        return $result;
    }

    public function listProduct($page = 0, $nbProduct = 25, $search = ""){
        if(preg_match("#^[0-9]+$#", $page) AND preg_match("#^[0-9]+$#", $nbProduct)) {
			if(isset($_SESSION['searchRequest'])){
				$data['title'] = "page : ".($page+1);
				$data['content'] = 'displayListProducts';
				$data['product'] = $this->Produit->getSearchList($page, $nbProduct);
				$data['nbPage'] = $this->nbPage($data['product']['count']['count'], $nbProduct);
				$data['currentPage'] = $page;
				$data['currentNbProduct'] = $nbProduct;
                $data['search'] = $search;
				$this->load->vars($data);
				$this->load->view('advancedResearchTemplate');
			}else{
				$data['title'] = "page : ".($page+1);
				$data['content'] = 'displayListProducts';
				$data['product'] = $this->Produit->getProductList($page, $nbProduct, $search);
				$data['nbPage'] = $this->nbPage($data['product']['count']['count'], $nbProduct);
				$data['currentPage'] = $page;
				$data['currentNbProduct'] = $nbProduct;
				$data['search'] = $search;
				$this->load->vars($data);
				$this->load->view('template');
			}
        }else{
            show_404();
        }
    }




    public function toggleMarque() {
  		 $rep = "true" ;
  		 $marque = $this->input->post('marque');
  		 if ((isset ( $marque )) && ( empty( $marque ))){
  			 $rep = "false" ;
  		 }
  		 return $rep ;
  	 }



     public function createProduct(){
        $data['title'] = "creation de produit";
        $data['content'] = 'registerProduct';

        $data['additifs'] = $this->Produit->getAdditif();
        $data['marques'] = $this->Produit->getMarque();

        $this->load->vars($data);
        $this->load->view('template');
    }




    public function formRegisterProduct(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $nom = $this->input->post('nom');
        $portion = $this->input->post('portion');
        $marque = $this->input->post('marque');
        $marquedelist = $this->input->post('listbrands');
        $energie = $this->input->post('energie') ;
        $graisse= $this->input->post('graisse');
        $graisseSaturee= $this->input->post('graisseSaturee');
        $graisseTrans= $this->input->post('graisseTrans');
        $cholesterol= $this->input->post('cholesterol');
        $carbohydrates= $this->input->post('carbohydrates');
        $sucre= $this->input->post('sucre');
        $fibre= $this->input->post('fibre');
        $proteine= $this->input->post('proteine');
        $sel= $this->input->post('sel');
        $sodium= $this->input->post('sodium');
        $vitamineA= $this->input->post('vitamineA');
        $vitamineC= $this->input->post('vitamineC');
        $calcium= $this->input->post('calcium');
        $fer= $this->input->post('fer');
        
        $ingredient_list = $this->input->post('ingredient_list');
        echo $ingredient_list ; 

        //Ce qui concerne le nutriscore
        $nutriscore = $this->input->post('nutriscore');
        $scorenutri = $this->input->post('scoreNutritif');
        $argRank = 0;

       // ici test preliminaire sur la presence des champs dans la base
       if ( empty($energie)){
		    $energie = 'null' ; 
		}
       if (empty($graisse ) ){
		    $graisse= 'null' ; 
		}
       if (empty($graisseSaturee) ){
		     $graisseSaturee= 'null' ; 
		 }
	   if (empty($graisseTrans) ){  
		   $graisseTrans= 'null' ; 
	   }
       if (empty($cholesterol) ){ 
		   $cholesterol= 'null' ; 
	   }
       if (empty($carbohydrates) ){ 
		   $carbohydrates= 'null' ; 
	   }
       if (empty($sucre) ){ 
		   $sucre= 'null' ; 
	   }
       if (empty($fibre) ){ 
		   $fibre= 'null' ; 
	   }
       if (empty($proteine ) ) {
		   $proteine= 'null' ; 
	   }
       if (empty($sel)) { 
		   $sel='null' ; 
	   }
       if (empty($sodium ) ){ 
		   $sodium='null' ; 
	   }
       if (empty($vitamineA )){ 
		   $vitamineA= 'null' ;
	   } 
       if (empty($vitamineC) ) { 
		   $vitamineC= 'null' ; 
	   }
       if (empty($calcium) ) { 
		   $calcium= 'null' ; 
	   }
       if (empty($fer)) { 
		   $fer= 'null' ; 
	   }


        if((!empty($nom)) OR (!empty($portion)) OR (!empty($marque))){

			if (  $this->Produit_model->getVerifByName ( $nom ) == true ) {
				//	echo $nom." \n ";

          if ( $this->Produit_model->getVerifByBrands($marque )  == true ) {
          //    echo $marque." marque pas dans la liste  \n " ;

              if (  !empty( $nutriscore) ) {
              //  echo ($nutriscore) ;
              }
              else {
            //    echo " pas de nutriscore " ;
                $nutriscore = "";
              }

            }
            else {
    			//		echo " marque deja dans la liste " ;
    				}

				}
				else {
				//	echo " produit deja dans la base " ;
					}
		
        if ( empty($marque)  ) {
			echo $marque ; 
		
            $marque = $marquedelist ;
        }
        
        $date = date('Y-m-d H:i:s', time());


        //Ce qui concerne le produit en lui même (caracteristiques)
        $request = " insert into openfoodfacts._produit (created_t, last_modified_t, product_name, brands, serving_size, nutrition_grade_fr, energy_100g, fat_100g, satured_fat_100g,";
        $request =  $request. " trans_fat_100g , cholesterol_100g , carbohydrates_100g, sugars_100g, fibers_100g, proteins_100g, salt_100g, sodium_100g,";
        $request =  $request. " vitamin_a_100g, vitamin_c_100g, calcium_100g, iron_100g, nutrition_score_fr_100g ) values " ;

        $request=$request. "( '$date', '$date', '$nom', '$marque', '$portion', '$nutriscore', $energie,  $graisse, $graisseSaturee, $graisseTrans, $cholesterol,";
        $request=$request. " $carbohydrates, $sucre, $fibre, $proteine, $sel, $sodium, $vitamineA, $vitamineC, $calcium, $fer,   $scorenutri );";
        echo $request ;
        print_r ( $this->Produit_model->recup_table('openfoodfacts._produit') ) ;

	  // ici on execute la creation =) 
       $this->Produit_model->execute_creation( $request , $nom,$marque) ;

			}
      else {
        echo " creation impossible " ;

      }



}
	public function reset(){
		unset($_SESSION['searchRequest']);
		redirect('/Produits/listProduct');
	}

}
