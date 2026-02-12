<?php

 require_once 'models/worksmodels.php';

 class worksController {
    private $worksModel;

    public function __construct(worksModel $worksModel) {
        $this->worksModel = $worksModel;
}


    public function getgrandtitre() {
        $info = $this->worksModel->getInfo();
        return $info['grandtitre'];

}

    public function gettitre() {
        $info = $this->worksModel->getInfo();
        return $info['titre'];

}

    public function getimage() {
        $info = $this->worksModel->getInfo();
        return $info['image'];

}

    public function getdescription() {
        $info = $this->worksModel->getInfo();
        return $info['description'];

}

    public function getbouton() {
        $info = $this->worksModel->getInfo();
        return $info['bouton'];

}




  
 // Autres actions pour la gestion des utilisateurs...

 }
 
 ?>
