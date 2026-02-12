<?php

class AboutModel {

    private $pdo;

    // constructeur
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
     }
     
     // Méthode pour récupérer les informations de la base about
    public function getInfo() {
        $sql = 'SELECT * FROM about';
        $statement = $this->pdo->query($sql);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
 }

 ?>