<?php
require_once "./models/model.class.php";
require_once "./models/Component/component.class.php";

class ComponentManager extends Model{
    private $listeComponent;

    public function ajoutComponent($Component){
        $this->listeComponent[]=$Component;
    }
    public function getListeComponent(){return $this->listeComponent;}

    public function chargementListeComponent(){
        $req=$this->getBdd()->prepare("SELECT * FROM Component");
        $req->execute();
        $mesComponent=$req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($mesComponent as $Component){
            // genere Component de la classe Component
            $l=new Component($Component["idComponent"],$Component["titre"]);
            $this->ajoutComponent($l);
        }
    }
    public function getComponentById($idComponent){
        for($i=0;$i<count($this->listeComponent);$i++){
            if($this->listeComponent[$i]->getIdComponent() === $idComponent){
                return $this->listeComponent[$i];
            }
        }
    }
    public function ajoutComponentBd($titre){
        $req="INSERT INTO component (titre)
        value (:titre)";
        $stmt=$this->getBdd()->prepare($req);

        $stmt->bindValue(":titre",$titre,PDO::PARAM_STR);
        
        
        $resultat=$stmt->execute();
        $stmt->closeCursor();
        if($resultat>0){
            $component=new Component($this->getBdd()->lastInsertId(),$_SESSION["titre"]);
            $this->ajoutComponent($component);
        }
}
    public function suppressionComponentBd($idComponent){
        $req="DELETE from Component where idComponent= :idComponent";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":idComponent",$idComponent,PDO::PARAM_INT);
        $resultat=$stmt->execute();
        $stmt->closeCursor();
    
        if($resultat>0){
            $Component=$this->getComponentById($idComponent);
            unset($Component);
        }
    }
    public function modificationComponentBD($idComponent,$component){
        $req = "UPDATE component          
        set titre = :titre 
        where idComponent = :idComponent";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idComponent",$idComponent,PDO::PARAM_INT);
        $stmt->bindValue(":titre",$component,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    
        if($resultat>0){
            $this->getComponentById($idComponent)->setTitre($component);
        }
    }
    
}


?>