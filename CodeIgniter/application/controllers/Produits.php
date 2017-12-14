<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produits extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('html');

        $this->load->library('session');

        $this->load->model('Produit');
    }

    public function index(){
        $this->listProduct();
    }

    public function display($id){
        if(preg_match("#^[0-9]+$#", $id)){
            $data['title'] = 'Produit:'.$id;
            $data['content'] = 'displayOneProduct';
            $data['product'] = $this->Produit->getProductByID($id);
            if(isset($data['product'])){
                $this->load->vars($data);
                $this->load->view('template');
            }else{
                show_404();
            }
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
            $data['title'] = "page : ".($page+1);
            $data['content'] = 'displayListProducts';
            $data['product'] = $this->Produit->getProductList($page, $nbProduct, $search);
            $data['nbPage'] = $this->nbPage($data['product']['count']['count'], $nbProduct);
            $data['currentPage'] = $page;
            $data['currentNbProduct'] = $nbProduct;
            $data['search'] = $search;
            $this->load->vars($data);
            $this->load->view('template');
            
        }else{
            show_404();
        }
    }

    //Concerne le formulaire de quicksearch en haut de page
    public function formSearchProductByName(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nameProduct', 'nameProduct', 'required');

        $nameProduct = $this->input->post('nameProduct');

        redirect("Produits/listProduct/0/25/$nameProduct");
    }

    public function advancedResearch(){
        $data['title'] = "Recherche avancée";
        $data['content'] = 'advancedResearch';

        $data['additifs'] = $this->Produit->getAdditif();
        $data['marques'] = $this->Produit->getMarque();

        $this->load->vars($data);
        $this->load->view('advancedResearchTemplate');
    }

    public function formAdvancedSearch(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        

        //Ce qui concerne le produit en lui même (caracteristiques)
        $request = "SELECT id_produit, product_name, brands FROM openfoodfacts._produit ";
        
        
        $nom = $this->input->post('nom');
        $code = $this->input->post('code');
        $portion = $this->input->post('portion');
        $marque = $this->input->post('marque');
        
        $argRank = 0;
        
        if(!empty($nom)){
			if($argRank !=0){
				$request = $request."AND ";
			}else{
				$request = $request."WHERE ";
			}
			$request = $request."product_name = '$nom' ";
			$argRank = 1;
		}
		if(!empty($code)){
			if($argRank !=0){
				$request = $request."AND ";
			}else{
				$request = $request."WHERE ";
			}
			$request = $request."id_produit = '$code' ";
			$argRank = 1;
		}
		if(!empty($portion)){
			if($argRank !=0){
				$request = $request."AND ";
			}else{
				$request = $request."WHERE ";
			}
			$request = $request."serving_size = '$portion' ";
			$argRank = 1;
		}
		if(!empty($marque)){
			if($argRank !=0){
				$request = $request."AND ";
			}else{
				$request = $request."WHERE ";
			}
			$request = $request."brands = '$marque' ";
			$argRank = 1;
		}

        //Ce qui concerne le nutriscore
        $nutriA = $this->input->post('nutriscoreA');
        $nutriB = $this->input->post('nutriscoreB');
        $nutriC = $this->input->post('nutriscoreC');
        $nutriD = $this->input->post('nutriscoreD');
        $nutriE = $this->input->post('nutriscoreE');
        
        if((!empty($nutriA)) OR (!empty($nutriB)) OR (!empty($nutriC)) OR (!empty($nutriD)) OR (!empty($nutriE))){
			if($argRank == 0){
				$request = $request."WHERE ";
				$argRank = 1;
			}else{
				$request = $request."AND ";
			}
		}
        
        $argSubRank = 0;
        if(!empty($nutriA)){
			if($argSubRank == 0){
				$request = $request."( ";
				$argSubRank = 1;
			}else{
				$request = $request."OR ";
			}
			$request = $request."nutrition_grade_fr = '$nutriA' ";
		}
		if(!empty($nutriB)){
				if($argSubRank == 0){
					$request = $request."( ";
					$argSubRank = 1;
				}else{
					$request = $request."OR ";
				}
			
			$request = $request."nutrition_grade_fr = '$nutriB' ";
		}
		if(!empty($nutriC)){
				if($argSubRank == 0){
					$request = $request."( ";
					$argSubRank = 1;
				}else{
					$request = $request."OR ";
				}
			
			$request = $request."nutrition_grade_fr = '$nutriC' ";
		}
		if(!empty($nutriD)){
				if($argSubRank == 0){
					$request = $request."( ";
					$argSubRank = 1;
				}else{
					$request = $request."OR ";
				}
			
			$request = $request."nutrition_grade_fr = '$nutriD' ";
		}
		if(!empty($nutriE)){
				if($argSubRank == 0){
					$request = $request."( ";
					$argSubRank = 1;
				}else{
					$request = $request."OR ";
				}
			
			$request = $request."nutrition_grade_fr = '$nutriE' ";
		}
		if($argSubRank == 1){
			$request = $request." )";
		}
        

        
        

        //Ce qui concerne les additifs

        //Ce qui concerne les ingrédients

        //Ce qui concerne les valeurs nutritionnelles


		//$result = $this->Produit->advancedResearchQuery($request);
		
		
		$data['result'] = $nutriA;
		$data['test'] = $request;
		$_SESSION['request'] = $request;

        $data['title'] = "resultat recherche";
        $data['content'] = 'ok';

        $this->load->vars($data);
        $this->load->view('template');
    }

}




