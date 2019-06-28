<?php

//tableau FraisForfait 
// champs: 	id, libelle, montant
// deja remplie:
    // - ETP: Forfait Etape: 110.00
    // - KM: Frais Kilométrique: 0.62
    // - NUI: Nuitée Hôtel: 80.00
    // - REP: Repas Restaurant: 25.00


class FraitForfait{
    private $id;
    private $libelle;
    private $montant;

   
    public function __construct($id, $libelle, $montant){
        $this->id=$id;
        $this->libelle=$libelle;
        $this->montant=$montant;
    }
    
   

    

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get the value of montant
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */ 
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }
}


    
    


