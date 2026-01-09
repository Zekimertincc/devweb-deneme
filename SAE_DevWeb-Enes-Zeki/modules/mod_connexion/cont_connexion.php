<?php
include_once "modele_connexion.php";
include_once "vue_connexion.php";

class ControllerConnexion {
    private $vue;
    private $modele;
    private $action;

    function __construct() {
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'liste';
        $this->modele = new ModeleConnexion();
        $this->vue = new VueConnexion();
    }

    public function exec_action() {
        switch ($this->action) {
            case 'liste':
                $this->vue->liste();
                break;
            case 'connexion':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->modele->connexion();
                    $this->vue->liste();
                } else {
                    $this->vue->afficherFormulaireConnexion();
                }
                break;
            case 'inscription':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->modele->inscription();
                    $this->vue->liste();
                } else {
                    $this->vue->afficherFormulaireInscription();
                }
                break;
            case "deconnexion":
                $this->modele->deconnexion();
                break;
        }
        $this->vue->afficher();
    }
}