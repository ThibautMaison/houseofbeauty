<?php
require_once "./models/Image/imageManager.class.php";

class ImageController {
    private $imageManager;

    public function __construct() {
        $this->imageManager = new ImageManager;
        $this->imageManager->chargementListeImages();
    }
    public function afficherImage(){
        return $this->imageManager->getListeImages();
    
    }
    public function ajoutImageValidation(){
        // charge image
        $file=$_FILES["image"];
        // ajouter image au image public
        $repertoire="public/images/";
        $nomImageAjoute = $this->ajoutImage($file,$repertoire);
        
        $this->imageManager->ajoutImageBD($nomImageAjoute,$_POST["idComponent"]);
        header("Location: " .URL. "prestations");
        exit();
    }
    public function supprimerImage($idImage){
        $nomImage= $this->imageManager->getImageById($idImage)->getNomImage();
        // retire l'image de mon dossier
        unlink("public/images/".$nomImage);
        $this->imageManager->suppressionImageBd($idImage);
        header("Location: " .URL. "prestations");
    }
    public function modificationImage($idImage){
        $this->imageManager->getImageById($idImage);
        header("Location: " . URL . "prestations");
    }
    public function modificationImageValidation(){
        $this->imageManager->modificationImageBD($_POST["idImage"],$_POST["image"],$_POST["idComponent"]);
        $_SESSION['alert']= [
            "type"=> "success",
            "msg"=> "Modification Réalisé"
        ];
        header("Location: ".URL."prestation");
    }
    private function ajoutImage($file, $dir){

        // si la personne a oublier choisir un fichier
        if(!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");

        // sil y a pas de dossier on le cree
        // 0777 ce sont des droit
        if(!file_exists($dir)) mkdir($dir,0777);

        // recup extension fichier
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        // ajout numero fichier generer aleatoire (eviter dooublons)
        $random = rand(0,99999);
        // genere nom fichier
        $target_file = $dir.$random."_".$file['name'];

        // verifie si bien une image
        if(!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        // verifie extension
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        // verifie si existe pas deja
        if(file_exists($target_file))
            throw new Exception("Le fichier existe déjà");
        // verifie taille
        if($file['size'] > 50000000)
            throw new Exception("Le fichier est trop gros");
        // si pas reusssi a ajouter image
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        //  si functionne dit nom image qui a été ajouter
        else return ($random."_".$file['name']);
    }
}
?>