<?php 
require_once "./models/Component/componentManager.class.php";

class ComponentController{
    private $componentManager;

    public function __construct(){

        $this->componentManager=new ComponentManager;
        $this->componentManager->chargementListeComponent();
    }
   public function afficherComponent(){
    return $this->componentManager->getListeComponent();
   } 
   public function ajoutComponentValidation(){

    $this->componentManager->ajoutComponentBD($_POST["titre"]);
    header("Location: " .URL. "prestations");
    exit();
}
   public function supprimerComponent($idComponent){
    $this->componentManager->suppressionComponentBd($idComponent);
    header("Location: " .URL. "prestations");
}
public function modificationComponent($idComponent){
    $this->componentManager->getComponentById($idComponent);
    header("Location: " . URL . "component");
}
public function modificationComponentValidation(){
    $this->componentManager->modificationComponentBD($_POST["idComponent"],$_POST["titre"]);
    $_SESSION['alert']= [
        "type"=> "success",
        "msg"=> "Modification Réalisé"
    ];
    header("Location: ".URL."component");
}
}
?>  