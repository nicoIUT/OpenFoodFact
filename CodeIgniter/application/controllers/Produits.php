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
        $data['title'] = 'ok';
        $data['content'] = 'ok';
        $this->load->vars($data);
        $this->load->view('template');
    }

    public function display($id){
        $data['title'] = 'Produit:'.$id;
        $data['content'] = 'displayOneProduct';
        $data['product'] = $this->Produit->getProductByID($id);;
        if(isset($data['product'])){
            $this->load->vars($data);
            $this->load->view('template');
        }else{
            show_404();
        }
    }

}




