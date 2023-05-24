<?php
class Users
{
    private $id;
    private $Pseudo;
    private $Email;
    private $Password;
    private $Role;

    public function __construct($id, $Pseudo, $Email, $Password, $Role)
    {
        $this->id = $id;
        $this->Pseudo = $Pseudo;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->Role = $Role;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPseudo()
    {
        return $this->Pseudo;
    }

    public function setPseudo($Pseudo)
    {
        $this->Pseudo = $Pseudo;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    public function getRole()
    {
        return $this->Role;
    }

    public function setRole($Role)
    {
        $this->Role = $Role;
    }
}
