<?php
require_once "./models/model.class.php";
require_once "./models/Image/image.class.php";

class ImageManager extends Model {
    private $listeImages;

    public function ajoutImage($image) {
        $this->listeImages[] = $image;
    }

    public function getListeImages() {
        return $this->listeImages;
    }

    public function chargementListeImages() {
        $req = $this->getBdd()->prepare("SELECT * FROM Image");
        $req->execute();
        $mesImages = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($mesImages as $image){
            // generate Image object of the Image class
            $i = new Image($image["idImage"], $image["nomImage"], $image["idComponent"]);
            $this->ajoutImage($i);
        }
    }
    public function getImageById($idImage){
        for($i=0;$i<count($this->listeImages);$i++){
            if($this->listeImages[$i]->getIdImage() === $idImage){
                return $this->listeImages[$i];
            }
        }
    }
    public function ajoutImageBd($image,$idComponent){
        $req="INSERT INTO image (nomImage,idComponent)
        value (:nomImage,:idComponent)";
        $stmt=$this->getBdd()->prepare($req);

        $stmt->bindValue(":nomImage",$image,PDO::PARAM_STR);
        $stmt->bindValue(":idComponent",$idComponent);
        
        $resultat=$stmt->execute();
        $stmt->closeCursor();
        if($resultat>0){
            $image=new Image($this->getBdd()->lastInsertId(),$image,$idComponent);
            $this->ajoutimage($image);
        }
}
    public function suppressionImageBd($idImage){
        $req="DELETE from Image where idImage= :idImage";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":idImage",$idImage,PDO::PARAM_INT);
        $resultat=$stmt->execute();
        $stmt->closeCursor();
    
        if($resultat>0){
            $image=$this->getImageById($idImage);
            unset($image);
        }
    }
    public function modificationImageBD($idImage,$image,$idComponent){
        $req = "UPDATE Image          
        set nomImage = :nomImage ,
        idComponent = :idComponent
        where idImage = :idImage";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idImage",$idImage,PDO::PARAM_INT);
        $stmt->bindValue(":nomImage",$image,PDO::PARAM_STR);
        $stmt->bindValue(":idComponent",$idComponent,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    
        if($resultat>0){
            $this->getImageById($idImage)->setNomImage($image);
        }
    }
}
?>