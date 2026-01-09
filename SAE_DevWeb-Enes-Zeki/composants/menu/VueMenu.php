<?php
include_once "VueGenerique.php";

class VueMenu extends VueGenerique {
    // On ajoute $role comme deuxième paramètre (optionnel)
    public function prepareMenu($estConnecte = false, $role = null) {
        
        $this->affichage .= '
        <nav class="navbar navbar-expand-lg bg-light rounded-4 px-3">
            <a class="navbar-brand fw-bold" href="index.php">E-BUVETTE</a>
            <div class="navbar-nav flex-wrap gap-2">';

        if ($estConnecte) {
            $this->affichage .= '<a class="nav-link" href="index.php?module=barman">Barman (Vente)</a>';
            $this->affichage .= '<a class="nav-link" href="index.php?module=historique">Historique</a>';

            // Utilisation du paramètre $role passé par le contrôleur
            if ($role === 'admin') {
                $this->affichage .= '<a class="nav-link" href="index.php?module=inventaire">Inventaire</a>';
                $this->affichage .= '<a class="nav-link" href="index.php?module=produit">Produits</a>';
            }

            $this->affichage .= '<a class="nav-link" href="index.php?module=solde">Solde</a>';
            $this->affichage .= '<a class="nav-link" href="index.php?module=profil">Mon Profil</a>';
            $this->affichage .= '<a class="nav-link text-danger" href="index.php?module=connexion&action=deconnexion">Déconnexion</a>';
        } else {
            $this->affichage .= '<a class="nav-link" href="index.php?module=connexion">Connexion</a>';
        }

        $this->affichage .= '
            </div>
        </nav>';
    }

    public function afficher() {
        echo $this->getAffichage();
    }
}
