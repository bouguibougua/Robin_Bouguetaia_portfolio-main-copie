<?php
class ProjetsModels {
private $pdo;
// constructeur
public function __construct(PDO $pdo) {
$this->pdo = $pdo;
}
// Méthode pour récupérer les informations de la base projets
public function getInfo() {
$sql = 'SELECT * FROM projets';
$statement = $this->pdo->query($sql);
return $statement->fetch(PDO::FETCH_ASSOC);}
}
?>