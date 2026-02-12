<?php

 require_once 'models/contactmodels.php';

 class ContactController {
    private $contactModel;

    public function __construct(contactModel $contactModel) {
        $this->contactModel = $contactModel;
    }

    public function gettitre() {
        $info = $this->contactModel->getInfo();
        return $info['titre'];

    }

    public function getdescription() {
        $info = $this->contactModel->getInfo();
        return $info['description'];

}

    public function getnom() {
        $info = $this->contactModel->getInfo();
        return $info['nom'];

}

    public function getemail() {
        $info = $this->contactModel->getInfo();
        return $info['email'];

}

    public function getsujet() {
        $info = $this->contactModel->getInfo();
        return $info['sujet'];

}

    public function getmessage() {
        $info = $this->contactModel->getInfo();
        return $info['message'];

}

    public function getbouton() {
        $info = $this->contactModel->getInfo();
        return $info['bouton'];

}




  
 // Autres actions pour la gestion des utilisateurs...

 }
 
 ?>
