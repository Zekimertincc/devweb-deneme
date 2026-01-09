<?php
require_once 'modele_produit.php';
require_once 'vue_produit.php';

class ContProduit
{
    private $modele;
    private $vue;
    private $action;

    public function __construct()
    {
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'liste';
        $this->modele = new ModeleProduit();
        $this->vue = new VueProduit();
    }

    public function exec_action()
    {
        switch ($this->action) {
            case 'liste':
                $this->liste();
                break;
            case 'details':
                if (isset($_GET['id'])) {
                    $this->details($_GET['id']);
                } else {
                    echo "Aucun ID de produit fourni.";
                }
                break;
            case 'ajout':
                $this->ajout();
                break;
            default:
                echo "Action non reconnue.";
        }
    }

    public function liste()
    {
        $idAsso = isset($_SESSION['idAsso']) ? $_SESSION['idAsso'] : null;
        $produits = $this->modele->getListe($idAsso);
        $this->vue->affiche_liste($produits);
        $this->vue->afficher();
    }

    public function details($id)
    {
        $produit = $this->modele->getDetails($id);
        $this->vue->affiche_details($produit);
        $this->vue->afficher();
    }

    public function ajout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idAsso = isset($_SESSION['idAsso']) ? $_SESSION['idAsso'] : null;
            
            if ($idAsso !== null) {
                $this->modele->ajoutProduit($_POST, $idAsso);
                $this->vue->affiche_confirmation();
            } else {
                echo "Erreur : Vous devez être connecté à une association pour ajouter un produit.";
            }
        } else {
            $this->vue->form_ajout();
        }
        $this->vue->afficher();
    }
}