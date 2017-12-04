<?php
class  Produit  extends  CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }


    public function getProductByID($id)
        //Retourne le produit dont l'id est passé en paramètre
        //J'ai pas encore géré la differenciation entre les données importées et ajoutées
    {
        return $this->db->query("SELECT * FROM openfoodfacts._produit WHERE id_produit = $id")->row_array();
    }

}