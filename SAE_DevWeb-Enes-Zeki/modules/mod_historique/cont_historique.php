<?php
require_once 'modele_historique.php';
require_once 'vue_historique.php';

class ContHistorique {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleHistorique();
        $this->vue = new VueHistorique();
    }

    public function exec_action() {
        $idAsso = isset($_SESSION['idAsso']) ? $_SESSION['idAsso'] : 1;
        $commandes = $this->modele->getHistoriqueComplet($idAsso);
        $this->vue->afficherHistorique($commandes);
        
        $this->vue->afficher(); 
    }
}