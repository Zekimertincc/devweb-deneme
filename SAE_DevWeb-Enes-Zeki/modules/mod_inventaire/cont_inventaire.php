<?php
require_once 'modele_inventaire.php';
require_once 'vue_inventaire.php';

class ContInventaire {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleInventaire();
        $this->vue = new VueInventaire();
    }

    public function exec_action() {
        $idAsso = isset($_SESSION['idAsso']) ? $_SESSION['idAsso'] : 1;
        
        $inventaire = $this->modele->getInventaireComplet($idAsso);
        $nbAlertes = $this->modele->getStatsAlerte($idAsso);
        
        $this->vue->afficherInventaire($inventaire, $nbAlertes);
    }
}