<?php
require_once "./models/model.class.php";
require_once "./models/Users/users.class.php";

class UsersManager extends Model
{
    private $User; //tableau de Users

    public function ajoutUser($Users)
    {
        $this->User[] = $Users;
    }

    public function getUser()
    {
        return $this->User;
    }

    public function chargementUser()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM users");
        $req->execute();
        $mesUser = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        foreach ($mesUser as $Users) {
            $l = new Users($Users["idUsers"], $Users["Pseudo"], $Users["Email"], $Users["Password"], $Users["Role"]);
            $this->ajoutUser($l);
        }
    }
    public function getUsersById($id)
    {
        for ($i = 0; $i < count($this->User); $i++) {
            if ($this->User[$i]->getId() == $id) {
                return $this->User[$i];
            }
        }
    }

    public function ajoutUsersBd($pseudo, $email, $password)
    {
        // Hasher le mot de passe avant de l'insérer dans la base de données
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);
    
        // Insérer les données dans la base de données
        $req = "INSERT INTO users (Pseudo, Email, Password) VALUES (:pseudo, :email, :password)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password_hashed, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    
        if ($resultat > 0) {
            $Users = new Users($this->getBdd()->lastInsertId(), $pseudo, $email, $password_hashed, null);
            $this->ajoutUser($Users);
        }
    }

    public function ConnexionUser($Pseudo, $Password)
    {
        // Préparation de la requête pour récupérer l'utilisateur avec les informations de connexion
        $req = ("select * from users where Pseudo = :Pseudo");
        // Préparation de la requête à être exécutée
        $stmt = $this->getBdd()->prepare($req);
        // liaison des valeurs pour les paramètres de la requête
        $stmt->bindValue(":Pseudo", $Pseudo, PDO::PARAM_STR);
        // Exécution de la requête
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $_SESSION['Role'] = $data['Role'];
            $_SESSION['Email'] = $data['Email'];
            $_SESSION['idUsers'] = $data['idUsers'];
            if (password_verify($Password, $data['Password'])) {

                $_SESSION['Pseudo'] = $Pseudo;
            } else {
                echo "reessaye";
            }
            $stmt->closeCursor();
        }
    }
    public function modificationUsersBd($id, $Pseudo, $Email, $Role)
    {
        $req = "
    UPDATE users
    SET Pseudo= :Pseudo,Email= :Email,Role= :Role WHERE id= :id";

        // connexion à bd
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":Pseudo", $Pseudo, PDO::PARAM_STR);
        $stmt->bindValue(":Email", $Email, PDO::PARAM_STR);
        $stmt->bindValue(":Role", $Role, PDO::PARAM_INT);
        // sert à executer requete et a ajouter données à la bdd
        $resultat = $stmt->execute();
        // ferme connexion abdd
        $stmt->closeCursor();


        // si requete fonctionne 
        if ($resultat > 0) {
            // mettre a jour le tableau des Boutique

            var_dump($id);
            $this->getUsersById($id)->setPseudo($Pseudo);
            $this->getUsersById($id)->setEmail($Email);
            $this->getUsersById($id)->setRole($Role);
        }
    }

    public function suppressionUsersBd($id)
    {
        //  il est interdit de faire une concatenation avec $id, pour la securité
        $req = "
    DELETE from users where idUsers= :idUsers";
        // connexion à bd
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idUsers", $id, PDO::PARAM_INT);
        // sert à executer requete et a ajouter données à la bdd
        $resultat = $stmt->execute();
        // ferme connexion abdd
        $stmt->closeCursor();

        // si requete fonctionne 
        if ($resultat > 0) {
            // on supprime le Users au tableau de Users
            $Users = $this->getUsersById($id);
            unset($Users);
        }
    }
  
}
