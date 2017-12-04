<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('html');
	}
	
	
	public function index()
	
	{
		$this->load->vars($_SESSION) ; 
		$this->load->model('Produit_model')  ; 
		$this->load->view('affiche_produit');
		$_SESSION['title'] = $produit ; 
		
		
		$this ->load ->helper('url');
	}
	
	public function display($id){
		$data['title'] = 'Produit:'.$id;
		$data['content'] = 'displayOneProduct';
		$data['product'] = $this->Produit_model->getProductByID($id);
		if(isset($data['post'])){
            $this->load->vars($data);
            $this->load->view('template');
        }else{
            show_404();
        }
	}
}
