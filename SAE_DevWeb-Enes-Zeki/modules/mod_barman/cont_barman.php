<?php
require_once 'modele_barman.php';
require_once 'vue_barman.php';

class ContBarman {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleBarman();
        $this->vue = new VueBarman();
    }

    public function exec_action() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'caisse';

        switch ($action) {
            case 'caisse':
                $this->afficherCaisse();
                break;
            case 'ajouter':
                $this->ajouterAuPanier();
                break;
            case 'vider':
                $this->viderPanier();
                break;
            case 'valider':
                $this->validerVente();
                break;
        }
    }

    private function afficherCaisse() {
        $idAsso = isset($_SESSION['idAsso']) ? $_SESSION['idAsso'] : 1;
        $produits = $this->modele->getProduits($idAsso);
        $panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];
        
        $this->vue->afficherCaisse($produits, $panier);
        $this->vue->afficher();
    }

    private function ajouterAuPanier() {
        $idProduit = isset($_GET['id']) ? $_GET['id'] : null;
        if ($idProduit) {
            $produit = $this->modele->getProduitById($idProduit);
            if ($produit) {
                // Initialise le panier si besoin
                if (!isset($_SESSION['panier'])) {
                    $_SESSION['panier'] = [];
                }

                // Ajoute ou incrémente la quantité
                if (isset($_SESSION['panier'][$idProduit])) {
                    $_SESSION['panier'][$idProduit]['qte']++;
                } else {
                    $_SESSION['panier'][$idProduit] = [
                        'nom' => $produit['nom'],
                        'prix' => $produit['prix'],
                        'qte' => 1
                    ];
                }
            }
        }
        header("Location: index.php?module=barman&action=caisse");
    }

    private function viderPanier() {
        unset($_SESSION['panier']);
        header("Location: index.php?module=barman&action=caisse");
    }

    private function validerVente() {
        $idClient = isset($_POST['id_client']) ? $_POST['id_client'] : null;
        $total = isset($_POST['total']) ? $_POST['total'] : 0;
        $idAsso = isset($_SESSION['idAsso']) ? $_SESSION['idAsso'] : 1;

        $success = false;
        if ($idClient && !empty($_SESSION['panier'])) {
            $success = $this->modele->enregistrerVente($idClient, $_SESSION['panier'], $total, $idAsso);
            if ($success) {
                unset($_SESSION['panier']);
            }
        }

        $this->vue->afficherConfirmation($success);
        $this->vue->afficher();
    }
}