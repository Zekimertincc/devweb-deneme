<?php
include_once "VueMenu.php";

class ControllerMenu
{
    private $vue;

    public function __construct()
    {
        $this->vue = new VueMenu();
    }

    public function afficherMenu()
    {
        $estConnecte = isset($_SESSION['login']);
        
        // On récupère le rôle stocké en session lors de la connexion
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

        $this->vue->prepareMenu($estConnecte, $role);
        $this->vue->afficher();
    }
}