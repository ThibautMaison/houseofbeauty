<?php
require_once "./models/model.class.php";
require_once "./models/Description/description.class.php";

class DescriptionManager extends Model{
    private $listeDescriptions;

    public function ajoutDescription($description){
        $this->listeDescriptions[] = $description;
    }

    public function getListeDescriptions(){
        return $this->listeDescriptions;
    }

    public function chargementListeDescriptions(){
        $req = $this->getBdd()->prepare("SELECT * FROM Description");
        $req->execute();
        $mesDescriptions = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($mesDescriptions as $description){
            // generate Description object of the Description class
            $d = new Description($description["idDescription"], $description["description"], $description["idComponent"]);
            $this->ajoutDescription($d);
        }
    }
    public function getDescriptionById($idDescription){
        for($i=0;$i<count($this->listeDescriptions);$i++){
            if($this->listeDescriptions[$i]->getIdDescription() === $idDescription){
                return $this->listeDescriptions[$i];
            }
        }
    }
    public function ajoutDescriptionBD($description,$idComponent){
        $req = "INSERT INTO description (description,idComponent) VALUE (:description,:idComponent)";
        $stmt=$this->getBdd()->prepare($req);

        $stmt->bindValue(":description",$description,PDO::PARAM_STR);
        $stmt->bindValue(":idComponent",$idComponent);
        
        $resultat=$stmt->execute();
        $stmt->closeCursor();
        if($resultat>0){
            $description=new Description($this->getBdd()->lastInsertId(),$description,$idComponent);
            $this->ajoutDescription($description);
        }
    }
    public function suppressionDescriptionBd($idDescription){
        $req="DELETE from Description where idDescription= :idDescription";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":idDescription",$idDescription,PDO::PARAM_INT);
        $resultat=$stmt->execute();
        $stmt->closeCursor();
    
        if($resultat>0){
            $description=$this->getDescriptionById($idDescription);
            unset($description);
        }
    }
    public function modificationDescriptionBD($idDescription,$description){
        $req = "UPDATE Description          
        set description = :description 
        where idDescription = :idDescription";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idDescription",$idDescription,PDO::PARAM_INT);
        $stmt->bindValue(":description",$description,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    
        if($resultat>0){
            $this->getDescriptionById($idDescription)->setTitre($description);
        }
    }
    
}
?>