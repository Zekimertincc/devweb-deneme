<?php
include_once "VueGenerique.php";

class VueHistorique extends VueGenerique {
    public function afficherHistorique($commandes) {
        $items = '';
        foreach ($commandes as $commande) {
            $label = htmlspecialchars($commande['prenom_client'] . ' ' . $commande['nom_client']);
            $total = htmlspecialchars($commande['total']);
            $date = htmlspecialchars($commande['dateCommande']);
            $items .= '<li class="d-flex justify-content-between"><span>' . $label . '</span><span>' . $total . '€</span></li>';
            $items .= '<li class="small text-muted mb-2">Commande du ' . $date . '</li>';
        }

        if ($items === '') {
            $items = '<li class="text-muted">Aucune commande enregistrée pour le moment.</li>';
        }

        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-4">
            <div class="fw-bold mb-4">E-BUVETTE</div>
            <h1 class="h6 fw-semibold mb-3">Historique des ventes</h1>

            <div class="balance-card mb-3 text-center">
              <div class="text-muted">Ventes du jour</div>
              <div class="display-6 fw-semibold">200€</div>
              <div class="history-card mt-3">
                <div class="fw-semibold mb-2">Historique des achats</div>
                <ul class="small text-start mb-2 list-unstyled">
                  ' . $items . '
                </ul>
                <div class="text-center small">Afficher plus</div>
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <a class="btn btn-outline-dark rounded-pill px-4" href="index.php">Retour menu</a>
            </div>
          </main>
        </div>';
    }

    public function afficher() {
        echo $this->getAffichage();
    }
}
