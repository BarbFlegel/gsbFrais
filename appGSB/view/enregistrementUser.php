<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>GSB</title>
	<link rel="stylesheet" href="/style/style.css">
</head>
<body>
		<div class="container
		content">
		<div class="main block">
			<article class="post">
				<h2>Enregistrement User</h2>
				<p class="meta"></p>
				<p>
			    <form action="index.php/create" method="GET">
			    	 <p><label for="nom">nom</label> <input type="text" name="nom" id="nom"/></p>
			    	 <p><label for="prenom">prenom</label> <input type="text" name="prenom" id="prenom"/></p>
			    	 <p><label for="datenaissance">date de naissance</label> <input type="text" name="datenaissance" id="datenaissance"/></p>
			    	 <p><label for="login">login</label> <input type="text" name="login" id="login"/></p>
			    	 <p><label for="password">password</label> <input type="text" name="password" id="password"/></p>
			    	 <p><label for="email">email</label> <input type="text" name="email" id="email"/></p>
			    	 <input type="hidden" value="create" name="action" />
			    	 <p><input type="submit" value="enregistrer" /></p>
			    	 <?php if ((isset($existeuser)) && ($existeuser)){?>
			    	 <p>utilisateur deja existant</p>
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
