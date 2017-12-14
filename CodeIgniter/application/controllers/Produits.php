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
        $nom = $this->input->post('nom');
        $code = $this->input->post('code');
        $portion = $this->input->post('portion');
        $pays =  $this->input->post('pays');
        $marque = $this->input->post('marque');

        //Ce qui concerne le nutriscore
        $nutriA = $this->input->post('nutriA');
        $nutriB = $this->input->post('nutriB');
        $nutriC = $this->input->post('nutriC');
        $nutriD = $this->input->post('nutriD');
        $nutriE = $this->input->post('nutriE');

        //Ce qui concerne les additifs

        //Ce qui concerne les ingrédients

        //Ce qui concerne les valeurs nutritionnelles



        $data['title'] = "resultat recherche";
        $data['content'] = 'ok';

        $this->load->vars($data);
        $this->load->view('template');
    }

}




