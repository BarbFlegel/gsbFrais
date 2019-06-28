<?php


class Dao{
    private static $serveur='mysql:host=localhost';
    private static $bdd='dbname=appgsb';
    //POur lma securite ne pas utiliser le super-administrateur
    private static $user='root' ;
    private static $mdp='' ;
    private static $monPdo;
    private static $monPdoGsb=null;
 
    
    /**
     * @return string
     */
    
    //Pour utiliser le pattern singleton on défini le constructeur comme private
    //COmme cela on ne l'utilise pas dans une autre classe.
    private function __construct(){
        Dao::$monPdo = new PDO(Dao::$serveur.';'.Dao::$bdd, Dao::$user, Dao::$mdp);
       
        
        
    }
    //Design pattern singleton
    public  static function getPdoGsb(){
        //On verifie que la connection n'a pas ete ouverte une premiere fois
        if(Dao::$monPdoGsb==null){
            Dao::$monPdoGsb= new Dao();
        }
        return Dao::$monPdoGsb;
    }
    

    // on recupere les informations du visiteur
    public function getInfosVisiteur($login, $mdp){
        $visiteur=null;
        $req = "select id,nom,prenom,login,mdp,adresse,cp,ville,dateEmbauche from visiteur where visiteur.login='$login' and visiteur.mdp='$mdp'";
        $ra = Dao::$monPdo->query($req);
        $laLigne = $ra->fetch();
        if ($laLigne != null){
        $id=$laLigne['id'];
        $nom= $laLigne['nom'];
        $prenom= $laLigne['prenom'];
        $login= $laLigne['login'];
        $mdp= $laLigne['mdp'];
        $adresse= $laLigne['adresse'];
        $cp= $laLigne['cp'];
        $ville= $laLigne['ville'];
        $dateEmbauche= $laLigne['dateEmbauche'];
        $visiteur=new Visiteur($id, $nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche);
        $visiteur->setId($id);
        }
        return $visiteur;
        }

    

    // on ajoute le visiteur 
    public function ajouterVisiteur(Visiteur $visiteur){
        $nom=$visiteur->getNom();
        $prenom=$visiteur->getPrenom();
        $login=$visiteur->getLogin();
        $mdp=$visiteur->getMdp();
        $adresse=$visiteur->getAdresse();
        $cp=$visiteur->getCp();
        $ville=$visiteur->getVille();
        $dateEmbauche=$visiteur->getDateEmbauche();
        $req = "insert into visiteur(nom,prenom,login,mdp,adresse,cp,ville,dateEmbauche) values (:nom,:prenom,:login,:mdp,:adresse,:cp,:ville,:dateEmbauche)";
        //Le try permet de gerer les exceptions si erreur dans le bloc try, alors catch se declenche.
        try{
            $stmt=Dao::$monPdo->prepare($req);
            $stmt->bindParam(':nom',$nom);
            $stmt->bindParam(':prenom',$prenom);
            $stmt->bindParam(':login',$login);
            $stmt->bindParam(':mdp',$mdp);
            $stmt->bindParam(':adresse',$adresse);
            $stmt->bindParam(':cp',$cp);
            $stmt->bindParam(':ville',$ville);
            $stmt->bindParam(':dateEmbauche',$dateEmbauche);
            $stmt->execute();
        }catch(Exception $e){
            echo "Erreur!".$e->getMessage();
            //Comme ca on evite d'afficher des infos sur la base de donnée
        }
    }



    //1) Ajouter la classe FicheFrais
    // les champs: idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat
    //2) NOT NOW enregistrement visiteur : frais forfait ajouter la classe FraisForfait
    // champs: 	id, libelle, montant
    //3.enregistrement visiteur : ligne frais forfait
    // champs: 	idVisiteur,	mois, idFraisForfait, quantite
    // 4. enregistrement visiteur : ligne frais hors forfait LigneFraisHorsForfait $ligneFraisHorsForfait
    // champs: 	id,	idVisiteur, mois, libelle, date, montant
    public function ajouterFrais(FicheFrais $ficheFrais, $listeFraisForfait, LigneFraisHorsForfait $ligneFraisHorsForfait){
        //On récupére les informations de FicheFrais
        $idVisiteur=$ficheFrais->getIdVisiteur();
        $mois=$ficheFrais->getMois();
        $nbJustificatifs=$ficheFrais->getNbJustificatifs();
        $montantValide=$ficheFrais->getMontantValide();
        $dateModif=Date("Y-m-d");
        $idEtat="CR";
        $req = "insert into fichefrais (idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) values ('$idVisiteur','$mois','$nbJustificatifs','$montantValide','$dateModif','$idEtat')";
        // $this->log($req);
        try{
            $stmt=Dao::$monPdo->prepare($req);
            $stmt->execute();
        }catch(Exception $e){
           "Erreur!".$e->getMessage();
        }

        //On récupére les informations de ligneFraisForfait
        foreach ($listeFraisForfait as $ligneFraisForfait) {
            $idVisiteur=$ligneFraisForfait->getIdVisiteur();
            $mois=$ligneFraisForfait->getMois();
            $idFraisForfait=$ligneFraisForfait->getIdFraisForfait();
            $quantite=$ligneFraisForfait->getQuantite();
            $req = "insert into lignefraisforfait (idVisiteur,	mois, idFraisForfait, quantite) values ('$idVisiteur','$mois','$idFraisForfait',$quantite)";
            $this->log($req);
            try{
                $stmt=Dao::$monPdo->prepare($req);
                $stmt->execute();
            }catch(Exception $e){
               "Erreur!".$e->getMessage();
            }
        }
        //On récupére les informations de ligneFraisHorsForfait
        $idVisiteur=$ligneFraisHorsForfait->getIdVisiteur();
        $mois=$ligneFraisHorsForfait->getMois();
        $libelle=$ligneFraisHorsForfait->getLibelle();
        $date=$ligneFraisHorsForfait->getDate();
        $montant=$ligneFraisHorsForfait->getMontant(); 
        $req = "insert into lignefraishorsforfait (idVisiteur, mois, libelle, date, montant) values ('$idVisiteur', '$mois' '$libelle','$date',$montant)";        
        try{
            $stmt=Dao::$monPdo->prepare($req);
            $stmt->execute();
        }catch(Exception $e){
           "Erreur!".$e->getMessage();
        }

        var_dump($req);
    }

 
    
    public function log($chaine){
        $monfichier = fopen('compteur.txt', 'r+');
    fputs($monfichier, $chaine);
     fclose($monfichier);
    }

    function consultationDesFrais($idVisiteur, $mois) {

        $lignesFraisHorsForfait = new LignesFraisHorsForfait();
        $getlignesFraisHorsForfait = $lignesFraisHorsForfait->getLignesFraisHorsForfait($idVisiteur, $mois);
        $lignesFraisHorsForfaitDetails = $getlignesFraisHorsForfait->fetchAll();
    
        $lignesFraisForfait = new LignesFraisForfait();
        $getLignesFraisForfait = $lignesFraisForfait->getLignesFraisForfait($idVisiteur, $mois);
        $lignesFraisForfaitDetails = $getLignesFraisForfait->fetchAll();
    
        require ('views/visiteur.php');
    
    }

}