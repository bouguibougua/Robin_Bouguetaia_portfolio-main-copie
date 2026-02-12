<?php

 require_once 'models/aboutmodels.php';

 class aboutController {
    private $aboutModel;

    public function __construct(aboutModel $aboutModel) {
        $this->aboutModel = $aboutModel;
    }

    public function getgrandtitre() {
        $info = $this->aboutModel->getInfo();
        return $info['grandtitre'];
    }

    public function getdescription() {
        $info = $this->aboutModel->getInfo();
        return $info['description'];
    }

    public function gettitre() {
        $info = $this->aboutModel->getInfo();
        return $info['titre'];
    }
   
    public function gettexte1() {
        $info = $this->aboutModel->getInfo();
        return $info['texte1'];
    }

    public function getgauge1() {
        $info = $this->aboutModel->getInfo();
        return $info['gauge1'];
    }

    public function gettexte2() {
        $info = $this->aboutModel->getInfo();
        return $info['texte2'];
    }

    public function getgauge2() {
        $info = $this->aboutModel->getInfo();
        return $info['gauge2'];
    }

    public function gettexte3() {
        $info = $this->aboutModel->getInfo();
        return $info['texte3'];
    }

    public function getgauge3() {
        $info = $this->aboutModel->getInfo();
        return $info['gauge3'];
    }

    public function gettexte4() {
        $info = $this->aboutModel->getInfo();
        return $info['texte4'];
    }

    public function getgauge4() {
        $info = $this->aboutModel->getInfo();
        return $info['gauge4'];
    }

    public function gettexte5() {
        $info = $this->aboutModel->getInfo();
        return $info['texte5'];
    }

    public function getgauge5() {
        $info = $this->aboutModel->getInfo();
        return $info['gauge5'];
    }

  

 }
 
 ?>
