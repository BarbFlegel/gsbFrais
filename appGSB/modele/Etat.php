<?php

// tableau Etat = Etat de facture
// champs: 	id, libelle

class Etat{
    private $id;
    private $libelle;
   
    public function __construct($libelle){
        $this->libelle=$libelle;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    
}