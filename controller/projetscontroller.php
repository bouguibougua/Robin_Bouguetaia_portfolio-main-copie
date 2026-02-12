<?php
require_once 'models/ProjetsModels.php';
class ProjetsController {
private $projetsModels;
public function __construct(ProjetsModels $ProjetsModels) {
$this->ProjetsModels = $ProjetsModels;
}

// Action Projets
public function getGrandtitre() {
    $info = $this->ProjetsModels->getInfo();
    return $info['titreprojets'];}

public function getimage1() {
    $info = $this->ProjetsModels->getInfo();
    return $info['image1'];}

public function getimage2() {
    $info = $this->ProjetsModels->getInfo();
    return $info['image2'];}

public function getimage3() {
    $info = $this->ProjetsModels->getInfo();
    return $info['image3'];}

public function getimage4() {
    $info = $this->ProjetsModels->getInfo();
    return $info['image4'];}

public function getimage5() {
    $info = $this->ProjetsModels->getInfo();
    return $info['image5'];}

public function getimage6() {
    $info = $this->ProjetsModels->getInfo();
    return $info['image6'];}

public function getimage7() {
    $info = $this->ProjetsModels->getInfo();
    return $info['image7'];}

public function getimage8() {
    $info = $this->ProjetsModels->getInfo();
    return $info['image8'];}





public function getbouton1() {
    $info = $this->ProjetsModels->getInfo();
    return $info['bouton1'];}

public function getbouton2() {
    $info = $this->ProjetsModels->getInfo();
    return $info['bouton2'];}

public function getbouton3() {
    $info = $this->ProjetsModels->getInfo();
    return $info['bouton3'];}

public function getbouton4() {
    $info = $this->ProjetsModels->getInfo();
    return $info['bouton4'];}

public function getbouton5() {
    $info = $this->ProjetsModels->getInfo();
    return $info['bouton5'];}

public function getbouton6() {
    $info = $this->ProjetsModels->getInfo();
    return $info['bouton6'];}

public function getbouton7() {
    $info = $this->ProjetsModels->getInfo();
    return $info['bouton7'];}

public function getbouton8() {
    $info = $this->ProjetsModels->getInfo();
    return $info['bouton8'];}





public function getdiv1() {
    $info = $this->ProjetsModels->getInfo();
    return $info['div1'];}

public function getdiv2() {
    $info = $this->ProjetsModels->getInfo();
    return $info['div2'];}

public function getdiv3() {
    $info = $this->ProjetsModels->getInfo();
    return $info['div3'];}

public function getdiv4() {
    $info = $this->ProjetsModels->getInfo();
    return $info['div4'];}

public function getdiv5() {
    $info = $this->ProjetsModels->getInfo();
    return $info['div5'];}

public function getdiv6() {
    $info = $this->ProjetsModels->getInfo();
    return $info['div6'];}

public function getdiv7() {
    $info = $this->ProjetsModels->getInfo();
    return $info['div7'];}

public function getdiv8() {
    $info = $this->ProjetsModels->getInfo();
    return $info['div8'];}




public function getdescription1() {
    $info = $this->ProjetsModels->getInfo();
    return $info['description1'];}

public function getdescription2() {
    $info = $this->ProjetsModels->getInfo();
    return $info['description2'];}

public function getdescription3() {
    $info = $this->ProjetsModels->getInfo();
    return $info['description3'];}

public function getdescription4() {
    $info = $this->ProjetsModels->getInfo();
    return $info['description4'];}

public function getdescription5() {
    $info = $this->ProjetsModels->getInfo();
    return $info['description5'];}

public function getdescription6() {
    $info = $this->ProjetsModels->getInfo();
    return $info['description6'];}

public function getdescription7() {
    $info = $this->ProjetsModels->getInfo();
    return $info['description7'];}

public function getdescription8() {
    $info = $this->ProjetsModels->getInfo();
    return $info['description8'];}



}
?>