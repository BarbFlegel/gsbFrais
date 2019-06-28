<?php
?>

<!DOCTYPE html>
<html>
<head>
	<title>Validation des Frais</title>
	<link rel="stylesheet" href="/style/style.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script type = "text/javascript" src = "js/fonction.js" ></script>

	<script langauge="JavaScript">

		var monthControl = document.querySelector('input[type="month"]');
		monthControl.value = '2019-06';

	</script>

</head>
<body>
		
		<nav class="nav main-nav" id="menu">
			<div class="container">
				<ul>
					<ul>
					<li><a href="index.html">Profile</a>
					<li><a href="#">Validation des Frais</a></li>
					<li><a href="#">Enregistrement des Frais</a>
				</ul>
			</div>
		</nav>
		
		<div class="container-fluid text-center bg-secondary text-light">
			<article class="post">
				<h2>COMPTABLE - Validation des Frais</h2>

				
			    <form action="/gsb/login.php" method="GET">
			    	<div class="form-group"> 
			    		<h5>Choisir le Visiteur</h5> 
					   	<select name="visiteur">
						    <option value="v1">v1</option>
						    <option value="v2">v2</option>
						    <option value="v3">v3</option>
						    <option value="v4">v4</option>
  						</select>
  						<label for="periodeMois">Mois</label> 
				    	<input id="validationMonth" type="month" name="validationMonth" value="2019-05">
			  		</div>
			    	 
			    	<div class="form-group">  
					    <h5>Frais au Forfait</h5>
					    <table>

					    	<tr>
					    		<td>Repas midi</td>
					    		<td>Nuitees midi</td>
					    		<td>Etape</td>
					    		<td>KM</td>
					    		<td>Situation</td>
					    	</tr>

					    	<tr>
					    		<td>
					    			<label for="repas"></label> <input type="text" name="repas" id="repas"/>
					    		</td>
					    		<td>
					    			<label for="nuitees"></label> <input type="text" name="nuitees" id="nuitees"/>
					    		</td>
					    		<td>
					    			<label for="etape"></label> <input type="text" name="etape" id="etape"/>
					    		</td>
					    		<td>
					    			<label for="km"></label> <input type="text" name="km" id="km"/>
					    		</td>
					    		<td>
					    			<select name="situation" size="1">
									  <option value="enregistre">Enregistre</option>
									  <option value="valide">Valide</option>
									  <option value="rembourse">Rembourse</option>
									</select>
					    		</td>
					    	</tr>

					    </table>
					   
					
			  		</div>


			  		<div class="form-group">  

					    <h5>Hors Forfait</h5>
					    <table>

					    	<tr>
					    		<td> </td>
					    		<td>Date</td>
					    		<td>Libelle</td>
					    		<td>Quantite</td>
					    		<td>Situation</td>
					    	</tr>

					    	<tr>
					    		<td>1. </td>
					    		<td>
					    			<label for="horsForDate"></label> <input type="date" name="horsForDate" id="horsForDate"/>
					    		</td>
					    		<td>
					    			<label for="horsForLibelle"></label> <input type="text" name="horsForLibelle" id="horsForLibelle"/>
					    		</td>
					    		<td>
					    			<label for="horsForQuantite"></label> <input type="number" name="horsForQuantite" id="horsForQuantite"min="1" max="10"/>
					    		</td>
					    		<td>
					    			<select name="situation" size="1">
									  <option value="enregistre">Enregistre</option>
									  <option value="valide">Valide</option>
									  <option value="rembourse">Rembourse</option>
									</select>
					    		</td>
					    	</tr>

					    </table>
					    

					    
			  		</div>


			  		<div class="form-group"> 
					    <h5>Hors Classification</h5>

					    <table>

					    	<tr>
					    		<td>Nombre de Justificatifs</td>
					    		<td>Montant total</td>
					    		<td>Situation</td>
					    	</tr>

					    	<tr>
					    		<td>
					    			<label for="horsClassJus"></label> 
					    			<input type="number" name="horsClassJus" id="horsClassJus"/>
					    		</td>
					    		<td>
					    			<label for="horsClassMontant"></label> 
					    			<input type="number" name="horsClassMontant" id="horsClassMontant"/>
					    		</td>
					    		<td>
					    			<select name="situation" size="1">
									  <option value="enregistre">Enregistre</option>
									  <option value="valide">Valide</option>
									  <option value="rembourse">Rembourse</option>
									</select>
					    		</td>
					    	</tr>

					    </table>

				
			 
			  		</div>



			    	 <?php //if ($existe===0){ ?>

			    	 <!--
			    	 <a href="/medianet1/index.php/enregistrer">enregistrez vous</a>
			    	-->
			    	 <?php //}?>

			    	 <div class="form-group"> 
			    	 	<input type="submit" value="valider"/>
			    	 	<input type="reset" value="annuler"/>
			    	 </div>
			    </form>
			</div>

		

	</body>
	</html>