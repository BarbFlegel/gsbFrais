<?php

//tableau ligneFraisForfait 
// champs: 	idVisiteur,	mois, idFraisForfait, quantite

class LigneFraisForfait{
    private $idVisiteur;
    private $mois;
    private $idFraisForfait;
    private $quantite;

   
    public function __construct($idVisiteur, $mois, $idFraisForfait,$quantite){
        $this->idVisiteur=$idVisiteur;
        $this->mois=$mois;
        $this->idFraisForfait=$idFraisForfait;
        $this->quantite=$quantite;
    }
    
   

    

    /**
     * Get the value of idVisiteur
     */ 
    public function getIdVisiteur()
    {
        return $this->idVisiteur;
    }

    /**
     * Set the value of idVisiteur
     *
     * @return  self
     */ 
    public function setIdVisiteur($idVisiteur)
    {
        $this->idVisiteur = $idVisiteur;

        return $this;
    }

    /**
     * Get the value of mois
     */ 
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set the value of mois
     *
     * @return  self
     */ 
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Set the value of idFraisForfait
     *
     * @return  self
     */ 
    public function setIdFraisForfait($idFraisForfait)
    {
        $this->idFraisForfait = $idFraisForfait;

        return $this;
    }
    public function getIdFraisForfait()
    {
        return $this->idFraisForfait;
    }

    /**
     * Get the value of quantite
     */ 
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */ 
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }
}


    
    


