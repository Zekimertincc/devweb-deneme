<?php
include_once "modele_solde.php";
include_once "vue_solde.php";

class ControllerSolde {
    private $modele;
    private $vue;
    private $action;

    public function __construct() {
        $this->modele = new ModeleSolde();
        $this->vue = new VueSolde();
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'formulaire';
    }

    public function exec_action() {
        switch ($this->action) {
            case 'formulaire':
                $this->vue->afficherFormulaireRecharge();
                break;
            case 'valider':
                if (isset($_POST['montant']) && isset($_SESSION['id_user'])) {
                    $res = $this->modele->rechargerCompte($_SESSION['id_user'], $_POST['montant'], $_POST['methode']);
                    $this->vue->afficherConfirmation($res);
                } else {
                    echo "Erreur : vous devez être connecté pour recharger votre compte.";
                }
                break;
        }
    }
}