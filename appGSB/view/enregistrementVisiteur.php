<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>GSB</title>
	<link rel="stylesheet" href="/style/style.css">
</head>
<body>
		<div class="container content">
		<div class="main block">
			<article class="post">
				<h2>Enregistrement Visiteur</h2>
				<p class="meta"></p>
				<p>
			    <form action="index.php/create" method="GET">
			    	 <p><label for="nom">nom</label> <input type="text" name="nom" id="nom"/></p>
			    	 <p><label for="prenom">prenom</label> <input type="text" name="prenom" id="prenom"/></p>
			    	 <p><label for="datenaissance">date de naissance</label> <input type="text" name="datenaissance" id="datenaissance"/></p>
			    	 <p><label for="login">login</label> <input type="text" name="login" id="login"/></p>			
			    	 <p><label for="mdp">password</label> <input type="text" name="mdp" id="mdp"/></p>
			    	 <p><label for="adresse">adresse</label> <input type="text" name="adresse" id="adresse"/></p>
			    	 <p><label for="cp">code postal</label> <input type="number" name="cp" id="cp"/></p>
			    	 <p><label for="ville">ville</label> <input type="text" name="ville" id="ville"/></p>
			    	 <p><label for="dateEmbauche">dateEmbauche</label> <input type="text" name="dateEmbauche" id="dateEmbauche"/></p>
			    	 <input type="hidden" value="create" name="action" />
			    	 <p><input type="submit" value="enregistrer" /></p>
			    	 <?php if ((isset($existeVisiteur)) && ($existeVisiteur)){?>
			    	 <p>visiteur deja existant</p>
			    	 <?php }?>
			    </form>
				</p>
			<div>
			<div class="container">
				<footer class="main-footer">
					<div class="f_left">
						<p>&amp;copy; 2019 - GSB</p>
					</div>
				</footer>
			</div>
		</div>
	</body>
	</html>
