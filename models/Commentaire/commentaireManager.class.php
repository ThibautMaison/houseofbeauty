<?php
require_once "./models/model.class.php";
require_once "./models/Commentaire/commentaire.class.php";

class CommentaireManager extends Model{
    private $listeCommentaire;

    public function ajoutCommentaire($commentaire){
        $this->listeCommentaire[]=$commentaire;
    }
    public function getListeCommentaire(){return $this->listeCommentaire;}

    public function chargementListeCommentaire(){
        $req=$this->getBdd()->prepare("SELECT commentaire.*,users.pseudo
        FROM commentaire 
        INNER JOIN users on users.idUsers = commentaire.idUsers");
        $req->execute();
        $mesCommentaire=$req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($mesCommentaire as $commentaire){
            // genere Commentaire de la classe Commentaire
            $l=new Commentaire($commentaire["idCommentaire"],$commentaire["commentaire"],$commentaire["dateCommentaire"],$commentaire["idUsers"],$commentaire["pseudo"]);
            $this->ajoutCommentaire($l);
        }
    }
    public function ajoutCommentaireBd($commentaire,$idUsers){
        $req="INSERT INTO commentaire (Commentaire,idUsers)
        value (:Commentaire,:idUsers)";
        $stmt=$this->getBdd()->prepare($req);

        $stmt->bindValue(":Commentaire",$commentaire,PDO::PARAM_STR);
        $stmt->bindValue(":idUsers",$idUsers);
        
        $resultat=$stmt->execute();
        $stmt->closeCursor();
        if($resultat>0){
            $commentaire=new Commentaire($this->getBdd()->lastInsertId(),$commentaire,date('Y-m-d H:i:s'),$idUsers,$_SESSION["pseudo"]);
            $this->ajoutCommentaire($commentaire);
        }
}
public function getCommentaireById($idCommentaire){
    for($i=0;$i<count($this->listeCommentaire);$i++){
        if($this->listeCommentaire[$i]->getIdCommentaire() === $idCommentaire){
            return $this->listeCommentaire[$i];
        }
    }
}
public function suppressionCommentaireBd($idCommentaire){
    $req="DELETE from Commentaire where idCommentaire= :idCommentaire";
    $stmt=$this->getBdd()->prepare($req);
    $stmt->bindValue(":idCommentaire",$idCommentaire,PDO::PARAM_INT);
    $resultat=$stmt->execute();
    $stmt->closeCursor();

    if($resultat>0){
        $Commentaire=$this->getCommentaireById($idCommentaire);
        unset($Commentaire);
    }
}
public function modificationCommentaireBD($idCommentaire,$commentaire){
    $req = "UPDATE commentaire          
    set commentaire = :commentaire ,
    where idCommentaire = :idCommentaire";
    $stmt = $this->getBdd()->prepare($req);
    $stmt->bindValue(":idCommentaire",$idCommentaire,PDO::PARAM_INT);
    $stmt->bindValue(":commentaire",$commentaire,PDO::PARAM_STR);
    $resultat = $stmt->execute();
    $stmt->closeCursor();

    if($resultat>0){
        $this->getCommentaireById($idCommentaire)->setCommentaire($commentaire);
    }
}
}
?>