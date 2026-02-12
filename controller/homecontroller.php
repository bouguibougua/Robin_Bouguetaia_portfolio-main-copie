<?php

require_once __DIR__ . '/../models/homeModels.php';

 class HomeController {
    private $homeModel;

    public function __construct(HomeModel $homeModel) {
        $this->homeModel = $homeModel;
    }

    public function getTitle() {
        $info = $this->homeModel->getInfo();
        return $info['title'];
    }

    public function getsubTitle() {
        $info = $this->homeModel->getInfo();
        return $info['subtitle1'];
    }

    public function getsubTitle2() {
        $info = $this->homeModel->getInfo();
        return $info['subtitle2'];
    }
   
    // Action pour afficher tous les utilisateurs
    public function getsubtitle3() {
        $info = $this->homeModel->getInfo();
        return $info['subtitle3'];
    }

    public function getbouton() {
        $info = $this->homeModel->getInfo();
        return $info['bouton'];
    }

    public function getimage() {
        $info = $this->homeModel->getInfo();
        return $info['image'];
    }

  
 // Autres actions pour la gestion des utilisateurs...

 }
 
 ?>
