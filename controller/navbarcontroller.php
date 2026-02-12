<?php

 require_once 'models/navbarmodels.php';

 class navbarController {
    private $navbarModel;

    public function __construct(navbarModel $navbarModel) {
        $this->navbarModel = $navbarModel;
    }

    public function getgrandtitre() {
        $info = $this->navbarModel->getInfo();
        return $info['grandtitre'];
    }

    public function getsubTitle() {
        $info = $this->navbarModel->getInfo();
        return $info['lien1'];
    }

    public function getsubTitle2() {
        $info = $this->navbarModel->getInfo();
        return $info['lien2'];
    }
   
    // Action pour afficher tous les utilisateurs
    public function getsubtitle3() {
        $info = $this->navbarModel->getInfo();
        return $info['lien3'];
    }

    public function getbouton() {
        $info = $this->navbarModel->getInfo();
        return $info['lien4'];
    }

    public function getimage() {
        $info = $this->navbarModel->getInfo();
        return $info['lien5'];
    }

  
 // Autres actions pour la gestion des utilisateurs...

 }
 
 ?>
