<?php
?>

<!DOCTYPE html>
<html>
<head>
	<title>Gestion des Frais</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="../include/style/style.css">

	<!--<script type = "text/javascript" src = "js/fonction.js" ></script>-->


	<script langauge="text/javascript">
		

	</script>
		
	


</head>
<body>
	

<!-- NAV POUR VISITEUR -->
<nav id="menu">
	<ul>
		<li><a href="index.html">Profile</a>
		<li><a href="#sasie">Saisie des frais</a></li>
		<li><a href="#consultation">Consultation des frais</a></li>
	</ul>
</nav>
		

<!-- Suivi de Remboursement des Frais pour VISITEUR -->
<div class="container-fluid text-center bg-secondary text-light">
	<article class="consultation">
		<h2 id="consultation">VISITEUR - Suivi de Remboursement des Frais</h2>
	</article>

<table id="data-table" class="table table-condensed table-striped">

	<thead>
		<tr>	
			<th>Repas</th>
			<th>Nuitees</th>
			<th>Etape</th>
			<th>Km</th>
			<th>Situation</th>
			<th>Date Operation</th>
		</tr>
	</thead>
<?php
$liste = $frais->getFraisListe();
foreach($fraisListe as $fraisDetails){
$fraisDate = date("d/M/Y, H:i:s", strtotime($fraisDetails["date"]));
echo '
<tr>
	<td>'.$fraisDetails["repas"].'</td>
	<td>'.$fraisDetails["nuitees"].'</td>
	<td>'.$fraisDetails["etape"].'</td>
	<td>'.$fraisDetails["km"].'</td>
	<td>'.$fraisDetails["idEtat"].'</td>
	<td>'.$fraisDate.'</td>
</tr>
';
}
?>
</table>
</div>

	
	<form action="/gsb/consultation.php" method="POST">			

		<select class="custom-select" id="month" name="month">
			<option selected>Selectionner un mois</option>
			<option value="01">Janvier</option>
			<option value="02">Fevrier</option>
			<option value="03">Mars</option>
			<option value="04">Avril</option>
			<option value="05">Mai</option>
			<option value="06">Juin</option>
			<option value="07">Juillet</option>
			<option value="08">Août</option>
			<option value="09">Septembre</option>
			<option value="10">Octobre</option>
			<option value="11">Novembre</option>
			<option value="12">Decembre</option>
		</select>
		<div class="input-group-append">
			<button class="btn btn-primary" type="submit">Rechercher</button>
		</div>

                            
		<?php
		/** Si une erreur existe, on l'affiche */
		if (!empty($_SESSION['errors'])) {
		?>

		<div class="alert alert-primary alert-dismissible fade show" role="alert">
			<?= $_SESSION['errors'][0]; ?>
		</div>

		<?php
		/** Si un succés existe, on l'affiche */
		} elseif (!empty($_SESSION['success'])) {
		?>

		<div class="alert alert-primary alert-dismissible fade show" role="alert">
		Mois sélectionné :

		<?php
		/** On traduit le mois en fonction de son numéro */
		switch ($_POST['date']) {
			case '01':
				echo "Janvier";
				break;
			case '02':
				echo "Février";
				break;
			case '03':
				echo "Mars";
				break;
			case '04':
				echo "Avril";
				break;
			case '05':
				echo "Mai";
				break;
			case '06':
				echo "Juin";
				break;
			case '07':
				echo "Juillet";
				break;
			case '08':
				echo "Août";
				break;
			case '09':
				echo "Septembre";
				break;
			case '10':
				echo "Octobre";
				break;
			case '11':
				echo "Novembre";
				break;
			case '12':
				echo "Décembre";
				break;
		}
		?>
		</div>
	
		<?php
		}
		?>


		
	<?php

/** Si un mois a bien été séléctionné, on montre le tableau de frais hors forfait */
if (isset($_POST['date'])) {

    ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col"><?php echo $_SESSION['user']; ?><br>Libellé</th>
                <th scope="col">Montant</th>
                <th scope="col">Nombre</th>
                <th scope="col">Date</th>
                <th scope="col">Etat</th>
            </tr>
            </thead>
            <tbody>
            <?php

            /** @var mixed $ligneFHFDetails Contient les informations des Frais Hors Forfait et leurs états du visiteur connecté */
            foreach ($ligneFraisForfait as $ligneFFDetails) {

                ?>
                <tr>
                    <td><?= htmlspecialchars($ligneFFDetails['libelle']); ?></td>
                    <td><?= htmlspecialchars($ligneFFDetails['montant']); ?>€</td>
                    <td><?= htmlspecialchars($ligneFFDetails['nombre']); ?></td>
                    <td><?= htmlspecialchars(dateConvert($ligneFFDetails['dateAjout'])); ?></td>

                    <?php

                    /** On regarde quel est l'état de la ligne, et on modifie la couleur du boutton en fonction */
                    switch ($ligneFFDetails['idEtat']) {

                        case '1':
                            $buttonColorEtat = 'danger';
                            break;

                        case '2':
                            $buttonColorEtat = 'dark';
                            break;

                        case '3':
                            $buttonColorEtat = 'success';

                    }

                    ?>
                    <td><button type="button" class="btn btn-sm btn-outline-<?= $buttonColorEtat; ?>" disabled><?= htmlspecialchars($ligneFFDetails['elibelle']); ?></button></td>

                </tr>
                <?php

            }

            ?>
            </tbody>
        </table>
    </div>
    <?php

}

?>
			    	 
</form>
</div>

<div class="container">
	<footer class="main-footer">
		<div class="f_left">
			<p>&amp;copy; 2017 - GSB</p>
		</div>
	</footer>
</div>

</body>
</html>