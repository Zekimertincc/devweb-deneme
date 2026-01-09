<?php
include_once "VueGenerique.php";

class VueProfil extends VueGenerique {
    public function afficherProfil($user) {
        $nom = htmlspecialchars($user['NOM'] ?? '');
        $prenom = htmlspecialchars($user['PRENOM'] ?? '');
        $email = htmlspecialchars($user['email'] ?? '');

        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-4 text-center">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <div class="fw-bold">E-BUVETTE</div>
              <a class="fs-3 text-decoration-none text-dark" href="index.php">←</a>
            </div>

            <h1 class="h6 fw-semibold mb-4">Mon Profil</h1>

            <form class="d-grid gap-3 mb-4" action="index.php?module=profil&action=sauvegarder" method="POST">
              <div>
                <label class="form-label">Nom</label>
                <input type="text" class="form-control bg-light" name="nom" value="' . $nom . '" required>
              </div>
              <div>
                <label class="form-label">Prénom</label>
                <input type="text" class="form-control bg-light" name="prenom" value="' . $prenom . '" required>
              </div>
              <div>
                <label class="form-label">Email</label>
                <input type="email" class="form-control bg-light" name="email" value="' . $email . '" required>
              </div>
              <button class="btn profile-btn" type="submit">Enregistrer</button>
            </form>

            <div class="d-grid gap-3 mb-5">
              <button class="btn profile-btn" type="button">Données personnelles</button>
              <button class="btn profile-btn" type="button">Modes de paiement</button>
              <button class="btn profile-btn" type="button">Paramètres</button>
            </div>

            <div class="mt-auto">
              <div class="logout-icon mx-auto mb-2">⏻</div>
              <a class="logout text-decoration-none" href="index.php?module=connexion&action=deconnexion">Se déconnecter</a>
            </div>
          </main>
        </div>';
    }

    public function afficherMessage($success) {
        $message = $success
            ? '<div class="alert alert-success">Modifications enregistrées !</div>'
            : '<div class="alert alert-danger">Erreur de sauvegarde.</div>';

        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-4 text-center">
            <div class="fw-bold mb-4">E-BUVETTE</div>
            ' . $message . '
            <a class="btn btn-outline-pill w-75 mx-auto" href="index.php?module=profil">Retour au profil</a>
          </main>
        </div>';
    }

    public function afficher() {
        echo $this->getAffichage();
    }
}
