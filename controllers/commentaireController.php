<?php 
require_once "./models/Commentaire/commentaireManager.class.php";

class CommentaireController{
    private $commentaireManager;

    public function __construct(){

        $this->commentaireManager=new CommentaireManager;
        $this->commentaireManager->chargementListeCommentaire();
    }
    public function afficherCommentaire(){
        return $this->commentaireManager->getListeCommentaire();
    
       } 
    public function ajoutCommentaireValidation(){

        $this->commentaireManager->ajoutCommentaireBD($_POST["commentaire"],$_SESSION["idUsers"]);
        header("Location: " .URL. "avis");
        exit();
    }
    public function supprimerCommentaire($idCommentaire){
        $this->commentaireManager->suppressionCommentaireBd($idCommentaire);
        header("Location: " .URL. "avis");
    }
    public function modificationCommentaire($idCommentaire){
        $this->commentaireManager->getCommentaireById($idCommentaire);
        header("Location: " . URL . "commentaire");
    }
    public function modificationCommentaireValidation(){
        $this->commentaireManager->modificationCommentaireBD($_POST["idCommentaire"],$_POST["commentaire"]);
        $_SESSION['alert']= [
            "type"=> "success",
            "msg"=> "Modification Réalisé"
        ];
        header("Location: ".URL."commentaire");
    }
}
?>  