<?php

//On demarre une session (toujours la premiere instruction )
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>GSB</title>
	<link rel="stylesheet" href="/include/style/style.css">
</head>
<body>
<?php 

require("modele/Etat.php");
require("modele/FicheFrais.php");
require("modele/FraisForfait.php");
require("modele/ligneFraisForfait.php");
require("modele/ligneFraisHorsForfait.php");
require("modele/Visiteur.php");
require("controller/Dao.php");


// modification url
$action = explode ("/",parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// pour tester et voir le process de fonction explode var dump($action);
// var dump($action);

$action=end($action);

//pour tester le end echo $action;
// echo $action;


$existe=1;

//$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche


if (isset($existeVisiteur)) echo "bonjour".$existeVisiteur;

if ($action=="create") {
    $nom=$_GET["nom"];
    $prenom=$_GET["prenom"];
    $login=$_GET["login"];
    $mdp=$_GET["mdp"];
    $adresse=$_GET["adresse"];
    $cp=$_GET["cp"];
    $ville=$_GET["ville"];
    $dateEmbauche=$_GET["dateEmbauche"];
    $visiteur=new Visiteur($nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche);
    $dao=Dao::getPdoGsb();
    $existeVisiteur=$dao->verifierVisiteur($visiteur);
    if (!$existeVisiteur){
        $dao->ajouterVisiteur($visiteur);
        echo $dao;
        include("view/login.php");
    }else {
        include("view/enregistrementVisiteur.php");
    }
}

//login
if ($action=="index.php"){
    include("view/login.php");
}

if ($action=="login"){
    $login=$_GET["login"];
    $mdp=$_GET["mdp"];
    $dao=Dao::getPdoGsb();
    $visiteur=$dao->getInfosVisiteur($login, $mdp);
    if ($visiteur!=null){
        //$liste=$dao->ajouterFrais();        
        // on stocke l'id utilisateur pour le recuperer
        // afin  de le traiter ulteriment
        $_SESSION["id"]=$visiteur->getId();
        include("view/visiteurSaisirFrais.php");
    }else{
        $existe=0;
        include("view/login.php");
    }
}


//// TRAITEMENT DES FRAIS DE VISITEURS

//1) enregistrement visiteur : frais visiteur
// $idEtat=CR; TOUJOUR dans ll'enregisttrement
// champs: 	idVisiteur,	mois,	nbJustificatifs,	montantValide,	dateModif,	idEtat
//2) Enregistrement visiteur : frais forfait
// champs: 	id, libelle, montant
//3) enregistrement visiteur : ligne frais forfait
// champs: 	idVisiteur,	mois, idFraisForfait, quantite
//4)  enregistrement visiteur : ligne frais hors forfait LigneFraisHorsForfait $ligneFraisHorsForfait
// champs: 	id,	idVisiteur, mois, libelle, date, montant
if ($action=="enregistrer"){
    $dao=Dao::getPdoGsb();
    //1.FicheFrais
    $idVisiteur= $_SESSION["id"];
    $mois=$_GET["mois"];
    $nbJustificatifs=$_GET["nbJustificatifs"];
    $montantValide=$_GET["montantValide"];
    $dateModif=Date('Y-m-D');
    $idEtat='CR';
    $frais= new FicheFrais($idVisiteur, $mois, $nbJustificatifs, $montantValide, $dateModif, $idEtat);

    //lignefraitforfait utilisant les id de formulaire (visiteur.php) et id de table pour creer un nouveau ligne frais forfait
    $repas= $_GET["repas"];
    $nuitees= $_GET["nuitees"];
    $etape= $_GET["etape"];
    $km= $_GET["km"];
    $fraislignefraisforfait1= new LigneFraisForfait($idVisiteur, $mois, "REP",$repas);
    $fraislignefraisforfait2= new LigneFraisForfait($idVisiteur, $mois, "KM",$km);
    $fraislignefraisforfait3= new LigneFraisForfait($idVisiteur, $mois, "NUI",$nuitees);
    $fraislignefraisforfait4= new LigneFraisForfait($idVisiteur, $mois, "ETP",$etape);
    $liste[]=$fraislignefraisforfait1;
    $liste[]=$fraislignefraisforfait2;
    $liste[]=$fraislignefraisforfait3;
    $liste[]=$fraislignefraisforfait4;

    //4.ligneFraisHorsForfait
    $date=$_GET["date"];
    $libelle=$_GET["libelle"];
    $montant=$_GET["montant"];
    $lignefraishorsforfait=new LigneFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant);

    $dao->ajouterFrais($frais, $liste, $lignefraishorsforfait);
    
    include("view/visiteurSaisirFrais.php");
}

if ($action=="consulter"){
    if (isset($_POST['mois']) && $_POST['mois'] >= 01 && $_POST['mois'] <= 12) {
        $_SESSION['success'] = array(0 => $_POST['mois']);
        consultationDesFrais($_SESSION['idVisiteur'], $_POST['mois']);
        } else {
            $_SESSION['errors'] = array(0 => "Aucun mois n'a été sélectionné");
            consultationDesFrais($_SESSION['idVisiteur'], 00);
        }

}







?>
</body>
</html>

<?php 

//1. login vers page de login   x
    //if ($action=="index.php"){} 
    
//2. si login et mot de passe ok -> on affiche le menu du visiteur ou le menu du copmtable
    //if ($action=="login"){}

    //a. si visiteur -> on affiche le menu du visiteur 
                    
                    //1. si on clicke sur l'item nouveau -> on affiche le formulaire de la saisie des frais - Saisie des frais (gestionDesFrais)
                        //if ($action="nouvveauFrais"{}
                    
                        
                    //2. formulaire de la consultation - Consultation des frais (suiviDeRemboursement)
                    
    //b. sinon le menu du comptable -> on affiche le menu du comptable 
                                    
                                   //La validation des frais par le comptable - Validation des frais (validationDesFrais)
    

//4. on insere les donnees du formulaire dans la base de donnees



?>






