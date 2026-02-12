<?php

class NavbarModel {

    private $pdo;

    // constructeur
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
     }
     
     // Méthode pour récupérer les informations de la base navbar
    public function getInfo() {
        $sql = 'SELECT * FROM navbar';
        $statement = $this->pdo->query($sql);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
 }

 ?>