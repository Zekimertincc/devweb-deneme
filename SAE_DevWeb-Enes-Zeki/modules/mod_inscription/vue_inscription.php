<?php
include_once "VueGenerique.php";

class VueInscription extends VueGenerique {
    public function afficherFormulaire() {
        $csrfToken = htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8');
        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-5 shadow-sm">
            <div class="brand-title mb-4">E-BUVETTE</div>
            <h1 class="h4 fw-bold mb-4">Créer un compte</h1>

            <form class="d-grid gap-3" action="index.php?module=inscription&action=valider" method="post">
              <div>
                <label class="form-label">Nom</label>
                <input type="text" class="form-control bg-light" name="nom" required />
              </div>
              <div>
                <label class="form-label">Prénom</label>
                <input type="text" class="form-control bg-light" name="prenom" required />
              </div>
              <div>
                <label class="form-label">Email</label>
                <input type="email" class="form-control bg-light" name="email" required />
              </div>
              <div>
                <label class="form-label">Mot de passe</label>
                <input type="password" class="form-control bg-light" name="password" required />
              </div>
              <input type="hidden" name="csrf_token" value="' . $csrfToken . '">
              <button class="btn btn-outline-pill w-75 mx-auto" type="submit">Créer le compte</button>
            </form>
          </main>
        </div>';
    }

    public function afficherResultat($success) {
        $message = $success
            ? '<div class="alert alert-success">Compte créé avec succès !</div>'
            : '<div class="alert alert-danger">Erreur lors de la création.</div>';

        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-5 shadow-sm text-center">
            <div class="brand-title mb-4">E-BUVETTE</div>
            ' . $message . '
            <a class="btn btn-outline-pill w-75 mx-auto" href="index.php">Retour à l\'accueil</a>
          </main>
        </div>';
    }

    public function afficher() {
        echo $this->getAffichage();
    }
}
