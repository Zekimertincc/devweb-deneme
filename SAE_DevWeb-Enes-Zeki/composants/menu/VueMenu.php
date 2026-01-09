<?php
include_once "VueGenerique.php";

class VueMenu extends VueGenerique {
    // On ajoute $role comme deuxième paramètre (optionnel)
    public function prepareMenu($estConnecte = false, $role = null) {
        
        $this->affichage .= '
        <nav style="background-color: #333; padding: 10px;">
            <ul style="list-style: none; display: flex; gap: 15px; margin: 0;">
                <li><a href="index.php" style="color: white;">Accueil</a></li>';

        if ($estConnecte) {
            $this->affichage .= '<li><a href="index.php?module=barman" style="color: white;">Barman (Vente)</a></li>';
            $this->affichage .= '<li><a href="index.php?module=historique" style="color: white;">Historique</a></li>';

            // Utilisation du paramètre $role passé par le contrôleur
            if ($role === 'admin') {
                $this->affichage .= '<li><a href="index.php?module=inventaire" style="color: white;">Inventaire</a></li>';
                $this->affichage .= '<li><a href="index.php?module=produit" style="color: white;">Produits</a></li>';
            }

            $this->affichage .= '<li><a href="index.php?module=solde" style="color: white;">Solde</a></li>';
            $this->affichage .= '<li><a href="index.php?module=profil" style="color: white;">Mon Profil</a></li>';
            $this->affichage .= '<li><a href="index.php?module=connexion&action=deconnexion" style="color: white;">Déconnexion</a></li>';
        } else {
            $this->affichage .= '<li><a href="index.php?module=connexion" style="color: white;">Connexion</a></li>';
        }

        $this->affichage .= '
            </ul>
        </nav>';
    }

    public function afficher() {
        echo $this->getAffichage();
    }
}