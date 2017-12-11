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

    public function listProduct($page = 0, $nbProduct = 2){
        if(preg_match("#^[0-9]+$#", $page) AND preg_match("#^[0-9]+$#", $nbProduct)) {
            $data['title'] = "page : ".($page+1);
            $data['content'] = 'displayListProducts';
            $data['product'] = $this->Produit->getProductList($page, $nbProduct);
            $data['nbPage'] = $this->nbPage($data['product']['count']['count'], $nbProduct);
            $data['currentPage'] = $page;
            $data['currentNbProduct'] = $nbProduct;

            $this->load->vars($data);
            $this->load->view('template');
        }else{
            show_404();
        }
    }

}




