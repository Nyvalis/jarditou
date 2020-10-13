 <?php
		include "header.php";	 
        require "connexion_bdd.php"; 
       
		?>
		
<div class= "container">
		



		<form action ="produits_ajout_script.php" method="POST" enctype="multipart/form-data">



		<label for="categorie">Catégorie : </label>

						<!--  Requête et boucle qui permet de sélectionner la catégorie appropriée et l'ID qui lui est associé dans la Base de Données -->


<?php   					$categories = $db->query('SELECT cat_id, cat_nom FROM categories WHERE  cat_parent IS NULL');

							if (!$categories) 
								{
									$optionErreurs = $db->errorInfo();
									echo $optionErreur[2]; 
									die("Erreur dans la requête");
								}

							if ($categories->rowCount() == 0) 
								{
									die("La table option est vide");
								}
	
						echo'<select class="form-control mb-2" name ="categorie" id ="categorie">';
						
							foreach($categories as $catValues)// on parcourt le tableau Catégorie pour en extraire les catégories d'outils (cat_parents Null)
							{
							echo'<optgroup label="'.$catValues[1].'">';// catValues[1] renvoie le cat_nom--------- soucis : il me manque les catégories 2 et 3 ?!
							
								$sousCategorie= $db->query('SELECT cat_id, cat_nom FROM categories WHERE cat_parent='.$catValues[0].' and cat_parent IS NOT NULL');//catValues[0] renvoie le cat_id					
								
								foreach($sousCategorie as $sousCatValues)// on extrait les sous-catégories (cat_parent non Null)
									{
									echo'<option value="'.$souCatValues[0].'">'.$sousCatValues[1].'</option>';																			
									}
									
							echo'</optgroup>';
								
							}
						echo'</select>';
  
						$categories->closeCursor();
						$sousCategorie->closeCursor();
?>
						<!--                                  	Fin de la requête catégorie                                                          -->


		<label for="reference">Référence : </label>
		<input class= "form-control mb-2" type="text" name="reference">

		<label for="libelle">Libéllé : </label>
		<input class= "form-control mb-2" type="text" name="libelle">

		<label for="description">Description : </label>
		<textarea class= "form-control mb-2" name="description"></textarea>

		<label for="prix">Prix : </label>
		<input class= "form-control mb-2" type ="number" name="prix" step= "0.01" min="0.00" max="999999.99">

		<label for="stock">Stock : </label>
		<input class= "form-control mb-2" type="text" name="stock">

		<label for="couleur">Couleur : </label>
		<input class= "form-control mb-2" type="text" name="couleur">

		<label for="date_ajout">Date d'ajout : </label>
		<input class= "form-control mb-2" type="date" name="date_ajout">

		<label for="bloque">Bloqué ? :</label>
			<br>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="bloque" value ="1">Oui
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="bloque" value="0">Non
		</div>
			<br>
			
			
			
		
			
			<!--		Upload du fichier				-->
			
			<input type="file" name="fichier">
			<input type="hidden" name="MAX_FILE_SIZE" value="30000">
			
	  
			<!--										-->
			
		
				
				<br>
				<button class='btn btn-success mb-3 mt-3'>Ajouter</button>

		</form>
				<a href = "liste.php"><button class='btn btn-dark mb-3 mt-3'>Retour</button></a>


</div>
<?php include 'footer.php'?>