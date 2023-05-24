<?php
class Image {
    private $idImage;
    private $nomImage;
    private $idComponent;
  
    public function __construct($id, $nom, $idComponent) {
      $this->idImage = $id;
      $this->nomImage = $nom;
      $this->idComponent = $idComponent;
    }
  
    // Getter methods
    public function getIdImage() {
      return $this->idImage;
    }
  
    public function getNomImage() {
      return $this->nomImage;
    }
  
    public function getIdComponent() {
      return $this->idComponent;
    }
  
    // Setter methods
    public function setIdImage($id) {
      $this->idImage = $id;
    }
  
    public function setNomImage($nom) {
      $this->nomImage = $nom;
    }
  
    public function setIdComponent($idComponent) {
      $this->idComponent = $idComponent;
    }
  }
  

?>