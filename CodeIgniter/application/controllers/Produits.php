<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produits extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('html');

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

    public function formSearchProductByName(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nameProduct', 'nameProduct', 'required');

        $nameProduct = $this->input->post('nameProduct');

        redirect("Produits/listProduct/0/25/$nameProduct");
    }
    /*
      public function formSearchAvance($brands = 0 , $pays = 0 ,$ingredients=0 ){
        $this->load->helper('form');
        $this->load->library('form_validation');
	

       
		$brands = $this->input->post('brands');
		$pays = $this->input->post('pays');
		$ingredients=$this->input->post('ingredients');
		
		 if(preg_match("#^[0-9]+$#", $page) AND preg_match("#^[0-9]+$#", $nbProduct)) {
            $data['title'] = "page : ".($page+1);
            $data['content'] = 'displayListProducts';
            if ( $brands = 1 ) {
            $data['product'] = $this->Produit->getProducts_by_brands($page, $nbProduct, $search);
			}
			else if ( $pays = 1 ) {
            $data['product'] = $this->Produit->getProducts_by_pays($page, $nbProduct, $search);
			}
			else if ( $ingredients = 1 ) {
            $data['product'] = $this->Produit->getProducts_by_ingredients($page, $nbProduct, $search);
			}
            $data['nbPage'] = $this->nbPage($data['product']['count']['count'], $nbProduct);
            $data['currentPage'] = $page;
            $data['currentNbProduct'] = $nbProduct;
            $data['search'] = $search;
            
             
			if  (!empty($_POST['advance'] )) {	
				$data['recherche'] = 'display_empty';
			}
			else  {	
			
				$data['recherche'] = 'displaychoise';
			
			}
			
			
           
            $this->load->vars($data);
            $this->load->view('template');
        }else{
            show_404();
        }
        

        
    }
	*/


}




