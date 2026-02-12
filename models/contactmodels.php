<?php

class ContactModel {

    private $pdo;

    // constructeur
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
     }

    // Méthode pour récupérer les informations de la base contact
    public function getInfo() {
        $sql = 'SELECT * FROM contact';
        $statement = $this->pdo->query($sql);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
?>