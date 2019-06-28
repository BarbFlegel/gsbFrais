<?php
require("../modele/Visiteur.php");

class GuestBookTest extends TestCase{
    use TestCaseTrait;
    
    // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;
    
    // only instantiate PHPUnit\DbUnit\Database\Connection once per test
    private $conn = null;
    
    final public function getConnection() {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }
        
        return $this->conn;
    }
    
    
    
    public function testAddVisiteur() {
        //id, nom, prenom, datenaissance ,login, mdp, adresse, cp, ville, dateEmbauche
        $visiteur = new Visiteur();
        $visiteur->addVisiteur("George", "AP", "1990-02-01", "4545", "4545", "4545", "2010-02-04");
        echo $visiteur;
    }
}