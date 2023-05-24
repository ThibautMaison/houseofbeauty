<?php  

require_once "./models/Users/usersManager.class.php";

class UserController {
    private $UsersManager;

    public function __construct(){
        $this->UsersManager=new UsersManager;
        $this->UsersManager->chargementUser();
    }

    public function afficherUsersAdmin(){
        $Users=$this->UsersManager->getUser();
        require "views/AdminUsers.view.php";
    }
    
    public function connexion(){
        require "views/connexion.view.php";
    }

    public function inscription(){
        require "views/inscription.view.php";
    }

    public function ajoutUsers(){
        require "views/ajoutUsers.view.php";
    }

    public function ajoutUsersValidation(){
        $this->UsersManager->ajoutUsersBd($_SESSION["Pseudo"],$_SESSION["Email"],$_SESSION["Password"]);
        session_destroy();
        header("Location: ".URL."connexion"); 
    
        }
        public function ajoutUsersValidationAdmin(){
            $this->UsersManager->ajoutUsersBd($_POST["Pseudo"],$_POST["Email"],$_POST["Password"]);
            header("Location: ".URL."admin/users"); 
        
            }

    public function UsersValidation(){
        $this->UsersManager->ConnexionUser($_POST["Pseudo"],$_POST["Password"]);
        if (isset($_SESSION['Pseudo'])) {
            header("Location: ".URL."accueil");
        } else {
            header("Location: ".URL."connexion");
        }
    }


    public function suppressionUsers($id){
        $this->UsersManager->suppressionUsersBd($id);
        header("Location: ".URL."admin/users");
    }

    public function modificationUsers($id){
        $Users = $this->UsersManager->getUsersById($id);
        require "views/modifierUsers.view.php";
    }

    public function modificationUsersValidation(){
        $this->UsersManager->modificationUsersBd((int)$_POST["identifiant"],$_POST["Pseudo"], $_POST["Email"], $_POST["Role"]);
        header("Location: ".URL."admin/users");
    }


}
?>