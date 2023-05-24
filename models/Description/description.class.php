<?php
class Description {
    private $idDescription;
    private $prix;
    private $idComponent;
  
    public function __construct($id, $prix, $idComponent) {
      $this->idDescription = $id;
      $this->prix = $prix;
      $this->idComponent = $idComponent;
    }
  
    // Getter methods
    public function getIdDescription() {
      return $this->idDescription;
    }
  
    public function getPrix() {
      return $this->prix;
    }
  
    public function getIdComponent() {
      return $this->idComponent;
    }
  
    // Setter methods
    public function setIdDescription($id) {
      $this->idDescription = $id;
    }
  
    public function setPrix($prix) {
      $this->prix = $prix;
    }
  
    public function setIdComponent($idComponent) {
      $this->idComponent = $idComponent;
    }
  }
  
?>