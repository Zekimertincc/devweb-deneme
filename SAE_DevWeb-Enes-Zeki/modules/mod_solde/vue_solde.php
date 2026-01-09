<?php
include_once "VueGenerique.php";

class VueSolde extends VueGenerique {
    public function afficherFormulaireRecharge() {
        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-4 text-center">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <div class="fw-bold">E-BUVETTE</div>
              <a class="fs-3 text-decoration-none text-dark" href="index.php">←</a>
            </div>

            <h1 class="h6 fw-semibold mb-3">Montant a recharger</h1>
            <div class="amount-box mb-4">0.00€</div>

            <form class="d-grid gap-3" action="index.php?module=solde&action=valider" method="POST">
              <div>
                <label class="form-label">Montant (€)</label>
                <input type="number" step="0.01" name="montant" class="form-control bg-light" required>
              </div>
              <div>
                <label class="form-label">Moyen de paiement</label>
                <select name="methode" class="form-select bg-light">
                  <option value="Espèces">Espèces</option>
                  <option value="CB">Carte Bancaire</option>
                </select>
              </div>
              <button class="btn btn-dark-pill" type="submit">Payer</button>
            </form>
          </main>
        </div>';
    }

    public function afficherConfirmation($success) {
        $message = $success
            ? '<div class="alert alert-success">Compte rechargé avec succès !</div>'
            : '<div class="alert alert-danger">Erreur lors du rechargement.</div>';

        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-4 text-center">
            <div class="fw-bold mb-4">E-BUVETTE</div>
            ' . $message . '
            <a class="btn btn-outline-pill w-75 mx-auto" href="index.php">Retour accueil</a>
          </main>
        </div>';
    }

    public function afficher() {
        echo $this->getAffichage();
    }
}
