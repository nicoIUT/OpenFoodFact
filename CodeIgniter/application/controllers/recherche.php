<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recherche extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('html');

        $this->load->model('Produit');
        $this->load->model('Produit_model');
    }

    public function index(){
        $this->listProduct();
    }

    public function display($id){
        if(preg_match("#^[0-9]+$#", $id)){
           
            $data['additifs'] = $this->Produit->get_brands() ; 
            $data['ingredients'] = $this->Produit->getIngredientList();
            $data['$additifs'] = $this->Produit->get_additifs() ; 
           
            $data['pays']= $this -> get_pays() ;  
            if(isset($data['product'])){
                $this->load->vars($data);
                $this->load->view('template_recherche');
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

    public function listProduct($page = 0, $nbProduct = 25, $search = "" , $brand = "" , $ingredients ="" ,  $additifs ="" ){
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
        $brandProduct = $this->input->post('brandProduct');
        $ingredients = $this->input->post('ingredients');
         $additifs = $this->input->post('additifs');
       

       

        redirect("recherche/listProduct/0/25/$nameProduct/$bransProduct/$ingredients/$additifs");
    }
    
  
}




