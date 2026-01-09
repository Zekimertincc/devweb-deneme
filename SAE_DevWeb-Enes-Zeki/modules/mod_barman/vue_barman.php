<?php
include_once "VueGenerique.php";

class VueBarman extends VueGenerique {
    public function afficherCaisse($produits, $panier) {
        $total = 0;
        $produitsRows = '';
        foreach ($produits as $p) {
            $produitsRows .= '
            <div class="row g-2 align-items-center">
              <div class="col-6">' . htmlspecialchars($p['nom']) . '</div>
              <div class="col-4">' . htmlspecialchars($p['prix']) . '€</div>
              <div class="col-2 text-end product-check">
                <a class="text-success text-decoration-none" href="index.php?module=barman&action=ajouter&id=' . $p['id'] . '">✓</a>
              </div>
            </div>';
        }

        $panierRows = '';
        foreach ($panier as $item) {
            $sousTotal = $item['prix'] * $item['qte'];
            $total += $sousTotal;
            $panierRows .= '
            <div class="row g-2 align-items-center mb-1">
              <div class="col-6">• ' . htmlspecialchars($item['nom']) . ' x' . htmlspecialchars($item['qte']) . '</div>
              <div class="col-4">' . htmlspecialchars(number_format($sousTotal, 2, ',', ' ')) . '€</div>
              <div class="col-2 text-end cart-remove">×</div>
            </div>';
        }

        if ($produitsRows === '') {
            $produitsRows = '<div class="text-muted">Aucun produit disponible.</div>';
        }

        if ($panierRows === '') {
            $panierRows = '<div class="text-muted">Le panier est vide.</div>';
        }

        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-4">
            <div class="fw-bold mb-3">E-BUVETTE</div>

            <div class="row g-2 align-items-center fw-semibold small mb-2">
              <div class="col-6">Produits</div>
              <div class="col-4">Prix</div>
              <div class="col-2"></div>
            </div>
            <div class="d-grid gap-2 mb-4">
              ' . $produitsRows . '
            </div>

            <div class="cart-panel mb-3">
              <div class="fw-semibold mb-2">Panier client</div>
              ' . $panierRows . '
              <div class="mt-3">Montant : ' . htmlspecialchars(number_format($total, 2, ',', ' ')) . '€</div>
            </div>

            <form class="d-grid gap-2 mb-2" action="index.php?module=barman&action=valider" method="POST">
              <input type="hidden" name="total" value="' . htmlspecialchars($total) . '">
              <label class="form-label small mb-0">Saisir ID Client</label>
              <input type="number" name="id_client" class="form-control bg-light" placeholder="Ex: 42" required>
              <button class="btn btn-dark-pill" type="submit">Valider la transaction</button>
            </form>
            <a class="btn text-danger w-100" href="index.php?module=barman&action=vider">Annuler</a>
          </main>
        </div>';
    }

    public function afficherConfirmation($success) {
        $message = $success
            ? '<div class="alert alert-success">Succès ! La vente a été enregistrée et le compte du client a été débité.</div>'
            : '<div class="alert alert-danger">Erreur ! Impossible de valider la commande (solde insuffisant, stock épuisé ou ID client incorrect).</div>';

        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-4 text-center">
            <div class="fw-bold mb-4">E-BUVETTE</div>
            ' . $message . '
            <a class="btn btn-outline-pill w-75 mx-auto" href="index.php?module=barman&action=caisse">Retour à la caisse</a>
          </main>
        </div>';
    }

    public function afficher() {
        echo $this->getAffichage();
    }
}
