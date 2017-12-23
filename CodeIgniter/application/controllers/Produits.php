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
                $this->load->view('displayTemplate');
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
        $request = "";


        $nom = $this->input->post('nom');
        $code = $this->input->post('code');
        $portion = $this->input->post('portion');
        $marque = $this->input->post('marque');

        //Ce qui concerne le nutriscore
        $nutriA = $this->input->post('nutriscoreA');
        $nutriB = $this->input->post('nutriscoreB');
        $nutriC = $this->input->post('nutriscoreC');
        $nutriD = $this->input->post('nutriscoreD');
        $nutriE = $this->input->post('nutriscoreE');

        $argRank = 0;

        if((!empty($nom)) OR (!empty($code)) OR (!empty($portion)) OR (!empty($marque)) OR (!empty($nutriA)) OR (!empty($nutriB)) OR (!empty($nutriC)) OR (!empty($nutriD)) OR (!empty($nutriE))){
			$request = $request."(SELECT id_produit, product_name, brands FROM openfoodfacts._produit ";
		}


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
        if($argRank == 1){
			$request = $request." ) ";
		}

        //Ce qui concerne le pays de commercialisation
        $pays = $this->input->post('pays');
        if(!empty($pays)){
			if($argRank != 0){
				 $request = $request." INTERSECT ";
			}
			$request = $request."(SELECT openfoodfacts._produit.id_produit, product_name, brands
									FROM openfoodfacts._produit INNER JOIN openfoodfacts._payscommercialiseproduit
									ON openfoodfacts._produit.id_produit = openfoodfacts._payscommercialiseproduit.id_produit
									WHERE openfoodfacts._payscommercialiseproduit.pays = '$pays')";
			$argRank = 1;
		}

        //Ce qui concerne les additifs
		$additifs = $this->input->post('selectAdditif[]');
		if(!empty($additifs)){
			if($argRank !=0){
				$request = $request." INTERSECT ";
			}
			$request = $request."(SELECT openfoodfacts._produit.id_produit, product_name, brands
									FROM openfoodfacts._produit INNER JOIN openfoodfacts._additifcontenus
									ON openfoodfacts._produit.id_produit = openfoodfacts._additifcontenus.id_produit ";

			$argRank = 1;
			$subRankAdd = 0;
			foreach($additifs as $additif){
				if($subRankAdd == 0){
					$request = $request."WHERE ";
				}else{
					$request = $request."OR ";
				}
				$request = $request."openfoodfacts._additifcontenus.id_additif = '$additif' ";
				$subRankAdd = 1;
			}
			$request = $request.") ";
		}

        //Ce qui concerne les ingrédients
        $ingredientString = $this->input->post('ingredient');
		if(!empty($ingredientString)){
		    $ingredientString = str_replace(' ', '', $ingredientString);
		    $ingredients = explode(",", $ingredientString);
		    if($argRank != 0){
		        $request = $request." INTERSECT ";
            }

            $request = $request."((SELECT openfoodfacts._produit.id_produit, product_name, brands
                                    FROM openfoodfacts._produit INNER JOIN openfoodfacts._ingredienttexte
                                    ON openfoodfacts._produit.id_produit = openfoodfacts._ingredienttexte.id_produit ";
            $argRank = 1;
            $subRankIng = 0;
            foreach($ingredients as $ingredient){
                if($subRankIng == 0){
                    $request = $request."WHERE ";
                }else{
                    $request = $request."OR ";
                }
                $request = $request."UPPER(openfoodfacts._ingredienttexte.ingredient_text) LIKE UPPER('%$ingredient%') ";
                $subRankIng = 1;
            }
            $request = $request.") UNION (SELECT openfoodfacts._produit.id_produit, product_name, brands
                                  FROM openfoodfacts._produit INNER JOIN openfoodfacts._ingredientduproduit
                                  ON openfoodfacts._produit.id_produit = openfoodfacts._ingredientduproduit.id_produit
                                  INNER JOIN openfoodfacts._ingredient
                                  ON openfoodfacts._ingredient.id_ingredient = openfoodfacts._ingredientduproduit.id_ingredient ";
            $subRankIng2 = 0;
            foreach($ingredients as $ingredient) {
                if ($subRankIng == 0) {
                    $request = $request . "WHERE ";
                } else {
                    $request = $request . "OR ";
                }
                $request = $request . "UPPER(openfoodfacts._ingredient.ingredients_text) LIKE UPPER('%$ingredient%') ";
                $subRankIng2 = 1;
            }
            $request = $request."))";
        }


        //Ce qui concerne les valeurs nutritionnelles
		$energie = $this->input->post('energie');
		$graisse = $this->input->post('graisse');
		$graisseSaturee = $this->input->post('graisseSaturee');
		$graisseTrans = $this->input->post('graisseTrans');
		$cholesterol = $this->input->post('cholesterol');
		$carbohydrates = $this->input->post('carbohydrates');
		$sucre = $this->input->post('sucre');
		$fibre = $this->input->post('fibre');
		$proteine = $this->input->post('proteine');
		$sel = $this->input->post('sel');
		$sodium = $this->input->post('sodium');
		$vitamineA = $this->input->post('vitamineA');
		$vitamineC = $this->input->post('vitamineC');
		$calcium = $this->input->post('calcium');
		$fer = $this->input->post('fer');
		$scoreNutritif = $this->input->post('scoreNutritif');

		if((!empty($energie)) OR (!empty($graisse)) OR (!empty($graisseSaturee)) OR (!empty($graisseTrans)) OR (!empty($cholesterol)) OR (!empty($carbohydrates)) OR (!empty($sucre)) OR
		(!empty($fibre)) OR (!empty($proteine)) OR (!empty($sel)) OR (!empty($sodium)) OR (!empty($vitamineA)) OR (!empty($vitamineC)) OR (!empty($calcium)) OR (!empty($fer)) OR (!empty($scoreNutritif))){
			if($argRank != 0){
				$request = $request." INTERSECT ";
			}

			$request = $request."(SELECT id_produit, product_name, brands
								FROM openfoodfacts._produit ";

			$argRank = 1;
			$subRankNut = 0;

			if(!empty($energie)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supenergy = $this->input->post('supenergie');
				$infenergy = $this->input->post('infenergie');

				if(empty($supenergy) AND empty($infenergy)){
					$request = $request."(energy_100g = $energie) ";
				}else if(empty($supenergy) AND !empty($infenergy)){
					$request = $request."(energy_100g <= $energie) ";
				}else if(!empty($supenergy) AND empty($infenergy)){
					$request = $request."(energy_100g >= $energie) ";
				}else{
					$request = $request."(energy_100g >= $energie OR energy_100g <= $energie) ";
				}
			}

			if(!empty($graisse)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supgraisse = $this->input->post('supgraisse');
				$infgraisse = $this->input->post('infgraisse');

				if(empty($supgraisse) AND empty($infgraisse)){
					$request = $request."(fat_100g = $graisse) ";
				}else if(empty($supgraisse) AND !empty($infgraisse)){
					$request = $request."(fat_100g <= $graisse) ";
				}else if(!empty($supgraisse) AND empty($infgraisse)){
					$request = $request."(fat_100g >= $graisse) ";
				}else{
					$request = $request."(fat_100g >= $graisse OR fat_100g <= $graisse) ";
				}
			}

			if(!empty($graisseSaturee)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supgraisseSaturee = $this->input->post('supgraisseSaturee');
				$infgraisseSaturee = $this->input->post('infgraisseSaturee');

				if(empty($supgraisseSaturee) AND empty($infgraisseSaturee)){
					$request = $request."(satured_fat_100g = $graisseSaturee) ";
				}else if(empty($supgraisseSaturee) AND !empty($infgraisseSaturee)){
					$request = $request."(satured_fat_100g <= $graisseSaturee) ";
				}else if(!empty($supgraisseSaturee) AND empty($infgraisseSaturee)){
					$request = $request."(satured_fat_100g >= $graisseSaturee) ";
				}else{
					$request = $request."(satured_fat_100g >= $graisseSaturee OR satured_fat_100g <= $graisseSaturee) ";
				}
			}

			if(!empty($graisseTrans)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supgraisseTrans = $this->input->post('supgraisseTrans');
				$infgraisseTrans = $this->input->post('infgraisseTrans');

				if(empty($supgraisseTrans) AND empty($infgraisseTrans)){
					$request = $request."(trans_fat_100g = $graisseTrans) ";
				}else if(empty($supgraisseTrans) AND !empty($infgraisseTrans)){
					$request = $request."(trans_fat_100g <= $graisseTrans) ";
				}else if(!empty($supgraisseTrans) AND empty($infgraisseTrans)){
					$request = $request."(trans_fat_100g >= $graisseTrans) ";
				}else{
					$request = $request."(trans_fat_100g >= $graisseTrans OR trans_fat_100g <= $graisseTrans) ";
				}
			}

			if(!empty($cholesterol)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supcholesterol = $this->input->post('supcholesterol');
				$infcholesterol = $this->input->post('infcholesterol');

				if(empty($supcholesterol) AND empty($infcholesterol)){
					$request = $request."(cholesterol_100g = $cholesterol) ";
				}else if(empty($supcholesterol) AND !empty($infcholesterol)){
					$request = $request."(cholesterol_100g <= $cholesterol) ";
				}else if(!empty($supcholesterol) AND empty($infcholesterol)){
					$request = $request."(cholesterol_100g >= $cholesterol) ";
				}else{
					$request = $request."(cholesterol_100g >= $cholesterol OR cholesterol_100g <= $cholesterol) ";
				}
			}

			if(!empty($carbohydrates)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supcarbohydrates = $this->input->post('supcarbohydrates');
				$infcarbohydrates = $this->input->post('infcarbohydrates');

				if(empty($supcarbohydrates) AND empty($infcarbohydrates)){
					$request = $request."(carbohydrates_100g = $carbohydrates) ";
				}else if(empty($supcarbohydrates) AND !empty($infcarbohydrates)){
					$request = $request."(carbohydrates_100g <= $carbohydrates) ";
				}else if(!empty($supcarbohydrates) AND empty($infcarbohydrates)){
					$request = $request."(carbohydrates_100g >= $carbohydrates) ";
				}else{
					$request = $request."(carbohydrates_100g >= $carbohydrates OR carbohydrates_100g <= $carbohydrates) ";
				}
			}

			if(!empty($sucre)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supsucre = $this->input->post('supsucre');
				$infsucre = $this->input->post('infsucre');

				if(empty($supsucre) AND empty($infsucre)){
					$request = $request."(sugars_100g = $sucre) ";
				}else if(empty($supsucre) AND !empty($infsucre)){
					$request = $request."(sugars_100g <= $sucre) ";
				}else if(!empty($supsucre) AND empty($infsucre)){
					$request = $request."(sugars_100g >= $sucre) ";
				}else{
					$request = $request."(sugars_100g >= $sucre OR sugars_100g <= $sucre) ";
				}
			}

			if(!empty($fibre)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supfibre = $this->input->post('supfibre');
				$inffibre = $this->input->post('inffibre');

				if(empty($supfibre) AND empty($inffibre)){
					$request = $request."(fibers_100g = $fibre) ";
				}else if(empty($supfibre) AND !empty($inffibre)){
					$request = $request."(fibers_100g <= $fibre) ";
				}else if(!empty($supfibre) AND empty($inffibre)){
					$request = $request."(fibers_100g >= $fibre) ";
				}else{
					$request = $request."(fibers_100g >= $fibre OR fibers_100g <= $fibre) ";
				}
			}

			if(!empty($proteine)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supproteine = $this->input->post('supproteine');
				$infproteine = $this->input->post('infproteine');

				if(empty($supproteine) AND empty($infproteine)){
					$request = $request."(proteins_100g = $proteine) ";
				}else if(empty($supproteine) AND !empty($infproteine)){
					$request = $request."(proteins_100g <= $proteine) ";
				}else if(!empty($supproteine) AND empty($infproteine)){
					$request = $request."(proteins_100g >= $proteine) ";
				}else{
					$request = $request."(proteins_100g >= $proteine OR proteins_100g <= $proteine) ";
				}
			}

			if(!empty($sel)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supsel = $this->input->post('supsel');
				$infsel = $this->input->post('infsel');

				if(empty($supsel) AND empty($infsel)){
					$request = $request."(salt_100g = $sel) ";
				}else if(empty($supsel) AND !empty($infsel)){
					$request = $request."(salt_100g <= $sel) ";
				}else if(!empty($supsel) AND empty($infsel)){
					$request = $request."(salt_100g >= $sel) ";
				}else{
					$request = $request."(salt_100g >= $sel OR salt_100g <= $sel) ";
				}
			}

			if(!empty($sodium)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supsodium = $this->input->post('supsodium');
				$infsodium = $this->input->post('infsodium');

				if(empty($supsodium) AND empty($infsodium)){
					$request = $request."(sodium_100g = $sodium) ";
				}else if(empty($supsodium) AND !empty($infsodium)){
					$request = $request."(sodium_100g <= $sodium) ";
				}else if(!empty($supsodium) AND empty($infsodium)){
					$request = $request."(sodium_100g >= $sodium) ";
				}else{
					$request = $request."(sodium_100g >= $sodium OR sodium_100g <= $sodium) ";
				}
			}

			if(!empty($vitamineA)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supvitamineA = $this->input->post('supvitamineA');
				$infvitamineA = $this->input->post('infvitamineA');

				if(empty($supvitamineA) AND empty($infvitamineA)){
					$request = $request."(vitamin_a_100g = $vitamineA) ";
				}else if(empty($supvitamineA) AND !empty($infvitamineA)){
					$request = $request."(vitamin_a_100g <= $vitamineA) ";
				}else if(!empty($supvitamineA) AND empty($infvitamineA)){
					$request = $request."(vitamin_a_100g >= $vitamineA) ";
				}else{
					$request = $request."(vitamin_a_100g >= $vitamineA OR vitamin_a_100g <= $vitamineA) ";
				}
			}

			if(!empty($vitamineC)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supvitamineC = $this->input->post('supvitamineC');
				$infvitamineC = $this->input->post('infvitamineC');

				if(empty($supvitamineC) AND empty($infvitamineC)){
					$request = $request."(vitamin_c_100g = $vitamineC) ";
				}else if(empty($supvitamineC) AND !empty($infvitamineC)){
					$request = $request."(vitamin_c_100g <= $vitamineC) ";
				}else if(!empty($supvitamineC) AND empty($infvitamineC)){
					$request = $request."(vitamin_c_100g >= $vitamineC) ";
				}else{
					$request = $request."(vitamin_c_100g >= $vitamineC OR vitamin_c_100g <= $vitamineC) ";
				}
			}

			if(!empty($calcium)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supcalcium = $this->input->post('supcalcium');
				$infcalcium = $this->input->post('infcalcium');

				if(empty($supcalcium) AND empty($infcalcium)){
					$request = $request."(calcium_100g = $calcium) ";
				}else if(empty($supcalcium) AND !empty($infcalcium)){
					$request = $request."(calcium_100g <= $calcium) ";
				}else if(!empty($supcalcium) AND empty($infcalcium)){
					$request = $request."(calcium_100g >= $calcium) ";
				}else{
					$request = $request."(calcium_100g >= $calcium OR calcium_100g <= $calcium) ";
				}
			}

			if(!empty($fer)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supfer = $this->input->post('supfer');
				$inffer = $this->input->post('inffer');

				if(empty($supfer) AND empty($inffer)){
					$request = $request."(iron_100g = $fer) ";
				}else if(empty($supfer) AND !empty($inffer)){
					$request = $request."(iron_100g <= $fer) ";
				}else if(!empty($supfer) AND empty($inffer)){
					$request = $request."(iron_100g >= $fer) ";
				}else{
					$request = $request."(iron_100g >= $fer OR iron_100g <= $fer) ";
				}
			}

			if(!empty($scoreNutritif)){
				if($subRankNut == 0){
					$request = $request."WHERE ";
					$subRankNut = 1;
				}else{
					$request = $request."AND ";
				}
				$supscoreNutritif = $this->input->post('supscoreNutritif');
				$infscoreNutritif = $this->input->post('infscoreNutritif');

				if(empty($supscoreNutritif) AND empty($infscoreNutritif)){
					$request = $request."(nutrition_score_fr_100g = $scoreNutritif) ";
				}else if(empty($supscoreNutritif) AND !empty($infscoreNutritif)){
					$request = $request."(nutrition_score_fr_100g <= $scoreNutritif) ";
				}else if(!empty($supscoreNutritif) AND empty($infscoreNutritif)){
					$request = $request."(nutrition_score_fr_100g >= $scoreNutritif) ";
				}else{
					$request = $request."(nutrition_score_fr_100g >= $scoreNutritif OR nutrition_score_fr_100g <= $scoreNutritif) ";
				}
			}


			$request = $request.")";
		}



        $this->form_validation->set_rules('code','code','required');


		if(empty($request)){
			redirect('/Produits/advancedResearch');
        }else {
            $_SESSION['searchRequest'] = $request;
            redirect('/Produits/listProduct');
		}
	}

	public function resetSearch(){
		unset($_SESSION['searchRequest']);
		redirect('/Produits/listProduct');
	}

	public function updateProduct($id = 1){
        $data['title'] = "Modification : $id";
        $data['content'] = 'updateProduct';

        $data['additifs'] = $this->Produit->getAdditif();
        $data['marques'] = $this->Produit->getMarque();

        $data['product'] = $this->Produit->getProductByID($id);

        $this->load->vars($data);
        $this->load->view('displayTemplate');
    }

    public function formUpdateProduct(){

    }

}




