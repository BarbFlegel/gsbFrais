<?php
class DaoVisiteur{
    private static $serveur='mysql:host=localhost';
    private static $bdd='dbname=appGSB';
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
        daoVisiteur::$monPdo = new PDO(DaoVisiteur::$serveur.';'.DaoVisiteur::$bdd, DaoVisiteur::$user, DaoVisiteur::$mdp);
        
        
    }
    //Design pattern singleton
    public  static function getPdoGsb(){
        //On verifie que la connection n'a pas ete ouverte une premiere fois
        if(DaoVisiteur::$monPdoGsb==null){
            DaoVisiteur::$monPdoGsb= new DaoVisiteur();
        }
        return DaoVisiteur::$monPdoGsb;
    }
    
    //$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche
    
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
            $stmt=daoVisiteur::$monPdo->prepare($req);
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

    //$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche

    public function getInfosVisiteur($login, $mdp){
        $visiteur=null;
        $req = "select id,nom,prenom,login,mdp,adresse,cp,ville,dateEmbauche from visiteur where visiteur.login='$login' and visiteur.mdp='$mdp'";
        $ra = daoVisiteur::$monPdo->query($req);
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
    

    public function getLesarticles(){
        $liste=array();
        $req = "select id,nom,prenom,login,mdp,adresse,cp,ville,dateEmbauche from visiteur";
        $res = daoVisiteur::$monPdo->query($req);
        $laLigne = $res->fetch();
        while($laLigne != null)	{
            $id=$laLigne['id'];
            $nom= $laLigne['nom'];
            $prenom= $laLigne['prenom'];
            $login= $laLigne['login'];
            $mdp= $laLigne['mdp'];
            $adresse= $laLigne['adresse'];
            $cp= $laLigne['cp'];
            $ville= $laLigne['ville'];
            $dateEmbauche= $laLigne['dateEmbauche'];
            $post=new Visiteur($id,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche);
            $post->setId($id);
            $liste[]=$post;
            $laLigne = $res->fetch();
            // var_dump($liste);
        }
        return $liste;
        //var_dump($liste);
    }

       //*********1) Ajouter les trois classe FicheFrais, LigneFraisForfait, LigneFraisHorsForfait 
       public function ajouterFrais(FicheFrais $ficheFrais /*, LigneFraisForfait $ligneFraisForfait, LigneFraisHorsForfait $ligneFraisHorsForfait*/){
        //On récupére les informations de FicheFrais
        $idVisiteur=$_SESSION["ID"];
        $mois=$ficheFrais->getMois();
        $nbJustificatifs=$ficheFrais->getNbJustificatifs();
        $montantValide=$ficheFrais->getMontantValide();
        $dateModif=Date("Y-m-d");
        $idEtat="CR";   
        //$req = "insert into FraisForfait (idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) values (:idVisiteur,:mois,:nbJustificatifs,:montantValide,:dateModif,:idEtat)";
        $req = "insert into fichefrais (idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) values ('$idVisiteur','$mois',$nbJustificatifs,$montantValide,'$dateModif','$idEtat')";
        $this->log($req);
        //..........2) Le try permet de gerer les exceptions si erreur dans le bloc try, alors catch se declenche.
        try{
            $stmt=Dao::$monPdo->prepare($req);
//             $stmt->bindParam(':idVisiteur',$idVisiteur);
//             $stmt->bindParam(':mois',$mois);
//             $stmt->bindParam(':nbJustificatifs',$nbJustificatifs);
//             $stmt->bindParam(':montantValide',$montantValide);
//             $stmt->bindParam(':dateModif',$dateModif);
//             $stmt->bindParam(':idEtat',$idEtat1);
            $stmt->execute();
        }catch(Exception $e){
           "Erreur!".$e->getMessage();
            $this->log("Erreur!".$e->getMessage());
            //Comme ca on evite d'afficher des infos sur la base de donnée
        }
        
        //************5)On récupére les informations de LigneFraisForfait
        
        //************6) Ici on fait la même chose que ci-dessus pour FicheFrais
        
        
        //On recupere les informations de LigneFraisHorsForfait
        ////Ici on fait la même chose que ci-dessus pour FicheFrais
    }
    
    //**********Ici on recupere les informations du visiteur 
    public function getInfosVisiteur($login, $mdp){
        $visiteur=null;
        $req = "select id,nom,prenom,login,mdp,adresse,cp,ville,dateEmbauche from Visiteur
		where login='$login' and mdp='$mdp'";
        $this->log($req);
        $rs = Dao::$monPdo->query($req);
        $laLigne = $rs->fetch();
        if ($laLigne != null)	{
            $id=$laLigne['id'];
            $nom= $laLigne['nom'];
            $prenom= $laLigne['prenom'];
            $login= $laLigne['login'];
            $mdp= $laLigne['mdp'];
            $adresse= $laLigne['adresse'];
            $cp= $laLigne['cp'];
            $ville= $laLigne['ville'];
            $dateEmbauche= $laLigne['dateEmbauche'];
            $visiteur=new Visiteur($nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche);
            $visiteur->setId($id);
        }
        return $visiteur;
    }
    
    
    
    
    //***************recupere les frais pour la consultation par les visiteurs ou pour le comptable
    public function getLesFraisVisiteurByMoisAnnee($mois){
        $liste=array();
        $req = "select idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat from  FicheFrais where mois=$mois ";
        $res = Dao::$monPdo->query($req);
        $laLigne = $res->fetch();
        while($laLigne != null)	{
            $idVisiteur=$laLigne['idVisiteur'];
            $mois= $laLigne['mois'];
            $nbJustificatifs= $laLigne['nbJustificatifs'];
            $montantValide= $laLigne['montantValide'];
            $dateModif =$laLigne['dateModif'];
            $idEtat= $laLigne['idEtat'];
            $ficheFrais=new FicheFrais($nom,$prenom,$datenaissance,$login,$password,$email);
            $ficheFrais->setId($id);
            $liste[]=$user;
            $laLigne = $res->fetch();
        }
        return $liste;
    }
    
    public function log($chaine){
        $monfichier = fopen('compteur.txt', 'r+');
        fputs($monfichier, $chaine);
        fclose($monfichier);
    }

}
        
    
    
    
    
    // public function insererFraisForfait($login, $mdp){
    //     $visiteur=null;
    //     $req = "select idVisiteur,mois,idForfait,quantite from lignefraisforfait where visiteur.login='$login' and visiteur.mdp='$mdp'";
    //     $rs = DaoVisiteur::$monPdo->query($req);
    //     $laLigne = $rs->fetch();
    //     if ($laLigne != null)	{
    //         $idVisiteur=$laLigne['idVisiteur'];
    //         $mois= $laLigne['mois'];
    //         $idForfait= $laLigne['idForfait'];
    //         $quantite= $laLigne['quantite'];
    //         $frais=new FraisForfait($mois,$idForfait,$quantite);
    //         $frais->setId($idVisiteur);
    //     }
    //     return $visiteur;
    // }
    
    
       
        
        

    
    

    
    
    //recupere les utilisateurs
//     public function getLesUtilisateur(){
//         $liste=array();
//         $req = "select id,nom,prenom,datenaissance,login,password,email,nom from  user ";
//         $res = daoVisiteur::$monPdo->query($req);
//         $laLigne = $res->fetch();
//         while($laLigne != null)	{
//             $id=$laLigne['id'];
//             $nom= $laLigne['nom'];
//             $prenom= $laLigne['prenom'];
//             $datenaissance= $laLigne['datenaissance'];
//             $login= $laLigne['login'];
//             $password= $laLigne['password'];
//             $email= $laLigne['email'];
//             $user=new User($nom,$prenom,$datenaissance,$login,$password,$email);
//             $user->setId($id);
//             $liste[]=$user;
//             $laLigne = $res->fetch();
//         }
//         return $liste;
//     }
    
//     //recupere les utilisateurs
//     public function verifierUser(User $user){
//         $liste=array();
//         $req = "select id,nom,prenom,datenaissance,login,password,email,nom from  user ";
//         $res = daoVisiteur::$monPdo->query($req);
//         $laLigne = $res->fetch();
//         $existeuser=false;
//         while($laLigne != null && (!$existeuser))	{
//             $id=$laLigne['id'];
//             $nom= $laLigne['nom'];
//             $prenom= $laLigne['prenom'];
//             $datenaissance= $laLigne['datenaissance'];
//             $login= $laLigne['login'];
//             $password= $laLigne['password'];
//             $email= $laLigne['email'];
//             $user1=new User($nom,$prenom,$datenaissance,$login,$password,$email);
//             $user1->setId($id);
//             if ($user1->equals($user)) $existeuser=true;else $existeuser=false;
//             $laLigne = $res->fetch();
//         }
//         return $existeuser;
//     }
    
//     //recupere les utilisateurs
//     public function getFraisById($id){
//         $post=null;
//         $req = "select a.id as id1,titre,date,idauteur,article,nom from  article a ,user u where a.idauteur=u.id and a.id=$id";
//         $stmt = daoVisiteur::$monPdo->prepare($req);
//         $res=$stmt->execute();
//         while ($laLigne = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
//             $id=$laLigne[0];
//             $titre= $laLigne[1];
//             $date= $laLigne[2];
//             $idauteur= $laLigne[3];
//             $article= $laLigne[4];
//             $nom= $laLigne[5];
//             $post=new Article($titre,$date,$idauteur,$article);
//             $post->setId($id);
//             $post->setNom($nom);
//         }
//         return $post;
//     }
    
//     //recupere les utilisateurs
// /*     public function getLesarticles(){
//         $liste=array();
//         $req = "select a.id as id1,titre,date,idauteur,article,nom from  article a ,user u where a.idauteur=u.id";
//         $res = daoVisiteur::$monPdo->query($req);
//         $laLigne = $res->fetch();
//         while($laLigne != null)	{
//             $id=$laLigne['id1'];
//             $titre= $laLigne['titre'];
//             $date= $laLigne['date'];
//             $idauteur= $laLigne['idauteur'];
//             $article= $laLigne['article'];
//             $nom= $laLigne['nom'];
//             $post=new Article($id,$titre,$date,$idauteur,$article,$nom);
//             $post->setId($id);
//             $liste[]=$post;
//             $laLigne = $res->fetch();
//         }
//         return $liste;
//     } */
    
//     public function getLesarticles(){
//         $liste=array();
//         $req = "select a.id as id1,titre,date,idauteur,article,nom from  article a ,user u where a.idauteur=u.id";
//         $stmt = daoVisiteur::$monPdo->prepare($req);
//         $res=$stmt->execute();
//         while ($laLigne = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
//             $id=$laLigne[0];
//             $titre= $laLigne[1];
//             $date= $laLigne[2];
//             $idauteur= $laLigne[3];
//             $article= $laLigne[4];
//             $nom= $laLigne[5];
//             $post=new Article($titre,$date,$idauteur,$article);
//             $post->setId($id);
//             $post->setNom($nom);
//             $liste[]=$post;
//         }
//         return $liste;
//     }
    
    
//     public function ajouterFrais(Frais $frais){
        
//         $titre=$article->getTitre();
//         $date=$article->getDate();
//         $idauteur=$article->getIdauteur();
//         $article=$article->getArticle();
//         $req = "insert into article(titre,date,idauteur,article) values (:titre,:date,:idauteur,:article)";
//         //Le try permet de gerer les exceptions si erreur dans le bloc try, alors catch se declenche.
//         try{
//             $stmt=daoVisiteur::$monPdo->prepare($req);
//             $stmt->bindParam(':titre',$titre);
//             $stmt->bindParam(':date',$date);
//             $stmt->bindParam(':idauteur',$idauteur);
//             $stmt->bindParam(':article',$article);
//             $stmt->execute();
//         }catch(Exception $e){
//             $this->ecrirefichier("Erreur!".$e->getMessage());
//             //Comme ca on evite d'afficher des infos sur la base de donnée
//         }
        
        
//     }
//     public function ecrirefichier($texte){
//         $fichier=fopen("log.txt",'w+');
//         fwrite($fichier,$texte);
//         fclose($fichier);
//     }
    

