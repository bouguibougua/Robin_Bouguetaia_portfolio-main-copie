<?php

 require_once 'models/projetmodels.php';

 class projetController {
    private $projetModel;

    public function __construct(projetModel $projetModel) {
        $this->projetModel = $projetModel;
    }

    public function gettitre() {
        $info = $this->projetModel->getInfo();
        return $info['titre'];

    }

    public function getimage() {
        $info = $this->projetModel->getInfo();
        return $info['image'];

}

    public function getdescription() {
        $info = $this->projetModel->getInfo();
        return $info['description'];

}

    public function getbouton() {
        $info = $this->projetModel->getInfo();
        return $info['bouton'];

}




  
 // Autres actions pour la gestion des utilisateurs...

 }
 
 ?>
