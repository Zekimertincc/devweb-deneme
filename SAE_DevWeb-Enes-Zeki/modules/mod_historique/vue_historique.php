<?php
include_once "VueGenerique.php";

class VueHistorique extends VueGenerique {
    public function afficherHistorique($commandes) {
        $this->affichage .= "<h2>Historique des Ventes</h2>";

        if (empty($commandes)) {
            $this->affichage .= "<p>Aucune commande enregistrée pour le moment.</p>";
        } else {
            $this->affichage .= "<table border='1' style='width:100%; border-collapse: collapse; text-align: left;'>
                    <tr style='background-color: #34495e; color: white;'>
                        <th style='padding:10px;'>Date</th>
                        <th style='padding:10px;'>Client</th>
                        <th style='padding:10px;'>Montant Total</th>
                    </tr>";

            foreach ($commandes as $c) {
                $this->affichage .= "<tr>
                        <td style='padding:10px;'>" . $c['dateCommande'] . "</td>
                        <td style='padding:10px;'>" . htmlspecialchars($c['prenom_client'] . " " . $c['nom_client']) . "</td>
                        <td style='padding:10px;'>" . $c['total'] . " €</td>
                      </tr>";
            }
            $this->affichage .= "</table>";
        }
        $this->affichage .= "<br><a href='index.php'><button>Retour Menu</button></a>";
    }

    public function afficher() {
        echo $this->getAffichage();
    }
}