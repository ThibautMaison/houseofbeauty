<?php
class Commentaire {
    private $idCommentaire;
    private $commentaire;
    private $dateCommentaire;
    private $idUsers;
    private $pseudo;
  
    public function __construct($id, $comment ,$dateCommentaire, $userId,$pseudo) {
      $this->idCommentaire = $id;
      $this->commentaire = $comment;
      $this->dateCommentaire = $dateCommentaire;
      $this->idUsers = $userId;
      $this->pseudo = $pseudo;
    }
  
    // Getter methods
    public function getIdCommentaire() {
      return $this->idCommentaire;
    }
  
    public function getCommentaire() {
      return $this->commentaire;
    }
    public function getDateCommentaire(){
      return $this->dateCommentaire;
    }
  
    public function getIdUsers() {
      return $this->idUsers;
    }
    public function getPseudo() {
      return $this->pseudo;
    }
  
    // Setter methods
    public function setIdCommentaire($id) {
      $this->idCommentaire = $id;
    }
  
    public function setCommentaire($comment) {
      $this->commentaire = $comment;
    }

    public function setDateCommentaire($dateCommentaire){
      $this->dateCommentaire = $dateCommentaire;
    }
  
    public function setIdUsers($userId) {
      $this->idUsers = $userId;
    }
    public function setPseudo($pseudo){
      $this->pseudo = $pseudo;
    }
  }
?>