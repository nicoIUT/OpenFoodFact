<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Controller {

	
	
	
	
	public function index()
	
	{
		$this->load->vars($_SESSION) ; 
		$this->load->model('Produit_model')  ; 
		$this->load->view('affiche_produit');
		$_SESSION['title'] = $produit ; 
		
		
		$this ->load ->helper('url');
	}
}
