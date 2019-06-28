<?php
?>

<!DOCTYPE html>
<html>
<head>
	<title>GSB</title>
	<link rel="stylesheet" href="style/style.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container content container-fluid text-center bg-secondary text-light">
		<div class="main block"></div>
		
		<article class="post">
			
			<h2>GSB</h2>

			<h4>Login</h4>
			<h5>Suivi de Remboursement des Frais</h5>
			<p class="meta"></p>
			
		    <form action="index.php/login" method="GET">
		    	
		    	<div class="form-group">

			    	<label for="login">Login</label> 
			    	<input class="form-control " type="text" name="login" id="login"/>

			    	</br>
			    	
			    	<label for="mdp">Mot de passe</label> 
			    	<input class="form-control " type="text" name="mdp" id="mdp"/>

		    	</div>
		    	 

		    	 

		    	 <div class="form-group">
		    	 
			    	 <?php if ($existe===0){ ?>
			    	 
			    	 <a href="/appGSB/index.php/enregistrer"><input class="btn btn-primary" type="submit" value="valider"/></a>
			
			    	 <?php 
                        }
                     ?>
                     <input class="btn btn-primary" type="submit" value="valider"/>
			    	 <input class="btn btn-danger" type="reset" value="annuler"/>
		    	 </div>
		    </form>
			
			</div>
		</div>
	</body>
	</html>