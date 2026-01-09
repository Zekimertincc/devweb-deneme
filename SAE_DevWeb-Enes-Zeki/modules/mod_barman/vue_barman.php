<?php
include_once "VueGenerique.php";

class VueBarman extends VueGenerique {
    public function afficherCaisse($produits, $panier) {
        $this->affichage .= "<h2>Interface de Vente (Caisse)</h2>";
        $this->affichage .= "<div style='display:flex; flex-wrap:wrap; gap:20px;'>";
        
        $this->affichage .= "<div style='flex:2; min-width:300px;'><h3>Produits disponibles</h3>";
        $this->affichage .= "<div style='display:grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap:10px;'>";
        
        foreach ($produits as $p) {
            $this->affichage .= "
            <a href='index.php?module=barman&action=ajouter&id=" . $p['id'] . "' style='text-decoration:none;'>
                <button style='width:100%; height:80px; cursor:pointer; background-color:#f0f0f0; border:1px solid #ccc; border-radius:8px;'>
                    <strong>" . $p['nom'] . "</strong><br>" . $p['prix'] . "€
                </button>
            </a>";
        }
        $this->affichage .= "</div></div>";

        $this->affichage .= "<div style='flex:1; min-width:250px; border-left:1px solid #ccc; padding-left:20px; background-color:#fafafa;'>";
        $this->affichage .= "<h3>Panier actuel</h3>";
        $total = 0;
        
        if (empty($panier)) {
            $this->affichage .= "<p>Le panier est vide.</p>";
        } else {
            $this->affichage .= "<ul style='list-style:none; padding:0;'>";
            foreach ($panier as $item) {
                $sousTotal = $item['prix'] * $item['qte'];
                $total += $sousTotal;
                $this->affichage .= "<li style='margin-bottom:10px; border-bottom:1px solid #eee; padding-bottom:5px;'>
                    <strong>" . $item['nom'] . "</strong><br>
                    Quantité : " . $item['qte'] . " | Total : " . $sousTotal . "€
                </li>";
            }
            $this->affichage .= "</ul>";
            $this->affichage .= "<h4 style='font-size:1.2em; color:#2c3e50;'>TOTAL À PAYER : " . $total . "€</h4>";
            
            $this->affichage .= "
            <form action='index.php?module=barman&action=valider' method='POST' style='margin-top:20px;'>
                <input type='hidden' name='total' value='" . $total . "'>
                <label for='id_client'><strong>Saisir ID Client :</strong></label><br>
                <input type='number' name='id_client' id='id_client' required style='width:100%; padding:8px; margin-top:5px;' placeholder='Ex: 42'><br><br>
                <button type='submit' style='width:100%; padding:15px; background-color:#27ae60; color:white; border:none; border-radius:5px; font-weight:bold; cursor:pointer;'>
                    VALIDER LE DÉBIT
                </button>
            </form>";
            $this->affichage .= "<br><a href='index.php?module=barman&action=vider' style='color:#e74c3c;'>Vider le panier</a>";
        }
        $this->affichage .= "</div></div>";
    }

    public function afficherConfirmation($success) {
        if ($success) {
            $this->affichage .= "<div style='padding:20px; background-color:#d4edda; color:#155724; border-radius:5px; margin-top:20px;'>
                <strong>Succès !</strong> La vente a été enregistrée et le compte du client a été débité.
            </div>";
        } else {
            $this->affichage .= "<div style='padding:20px; background-color:#f8d7da; color:#721c24; border-radius:5px; margin-top:20px;'>
                <strong>Erreur !</strong> Impossible de valider la commande (solde insuffisant, stock épuisé ou ID client incorrect).
            </div>";
        }
        $this->affichage .= "<br><a href='index.php?module=barman&action=caisse'><button style='padding:10px 20px; cursor:pointer;'>Retour à la caisse</button></a>";
    }

    public function afficher() {
        echo $this->getAffichage();
    }
}