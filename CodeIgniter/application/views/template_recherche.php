<?php $additifs = [ 1 => [ "nom" => "coucou" ] ,
					2 => ['nom' => " lala "] 
				] ; 
	$ingredients = [ 1 => [ "nom" => "patate" ] ,
					2 => ['nom' => " pouaro "] ,
					3 => ['nom' => " carotte "] ,
					4 => ['nom' => " voila "] ,
					5 => ['nom' => " pouaro "] ,
					6 => ['nom' => " pouaro "] ,
					7 => ['nom' => " pouaro "] 
				] ; 
				?>



        	<form method="post" >
        		<p>
     			  	 <label for="pseudo"> mon du produit  :</label>
            		 <input type="text" name="nameProduct" placeholder=" nom" size="30" maxlength="10"> <br> 
            	 </p>
            </form>

            <form method="post" >
            	<p>
     			  	 <label for="pseudo"> mon de la marque  :</label>
           			 <input type="text" name="brandProduct" placeholder="marque" size="30" maxlength="10">    <br>
           		 </p>	 	
           	 </form>
            


           
 				 </p>

			</form>
            
            <form > 
            
            <h4> selectionner un additifs dans la liste   </h4>
            <SELECT name="additifs[]" multiple="multiple" size="7" style="width:100px;>">
				 
				<?php foreach (  $additifs as $ad  ) { 
				echo ("<option>". $ad['nom']."<br>") ;
				}   ?>

				<SELECT>
            
            </form> 


            <form > 
            
            <h4> selectionner un ingredients dans la liste  </h4>
            <SELECT name="ingredients[]" size="7" multiple="multiple" style="width:100px;>">
				 
				<?php foreach (  $ingredients as $ingredient ) { 
				echo ("<option>". $ingredient['nom']."<br>") ;
				}   ?>

				<SELECT>
            
            </form> 
            
            <button type='submit' class= 'btn btn-primary' value="Rechercher">Rechercher</button>



			<?php 

				if ( isset ($_POST['ingredients'] )){
					print_r($_POST['ingredients']);

				}
			 ?> 











            
