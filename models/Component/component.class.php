<?php
class Component {
    private $idComponent;
    private $titre;
  
    public function __construct($idComponent, $titre) {
      $this->idComponent = $idComponent;
      $this->titre = $titre;

    }
  
    // Getter methods
    public function getIdComponent() {
      return $this->idComponent;
    }
  
    public function getTitre() {
      return $this->titre;
    }

  
    // Setter methods
    public function setIdComponent($id) {
      $this->idComponent = $id;
    }
  
    public function setTitre($titre) {
      $this->titre = $titre;
    }
  }
?>