<?php
include_once "VueGenerique.php";

class VueConnexion extends VueGenerique {
    function afficherFormulaireConnexion() {
        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-5 shadow-sm">
            <div class="brand-title mb-4">E-BUVETTE</div>
            <h1 class="h4 fw-bold mb-4">Connexion</h1>

            <form class="d-grid gap-3" action="index.php?module=connexion&action=connexion" method="POST">
              <div>
                <label class="form-label">Email</label>
                <input type="email" class="form-control bg-light" name="login" required />
              </div>
              <div>
                <label class="form-label">Mot de passe</label>
                <input type="password" class="form-control bg-light" name="password" required />
              </div>
              <a class="text-decoration-none small text-primary" href="#">Mot de passe oublié ?</a>
              <button class="btn btn-outline-pill w-75 mx-auto" type="submit">Connexion</button>
            </form>
            <p class="text-center text-muted small mt-4">
              Pas de compte? <a class="text-decoration-none" href="index.php?module=inscription">Ouvrez votre compte</a>.
            </p>
          </main>
        </div>';
    }

    function afficherFormulaireInscription() {
        $this->affichage .= '
        <div class="mobile-wrap py-4">
          <main class="mobile-screen px-4 py-5 shadow-sm">
            <div class="brand-title mb-4">E-BUVETTE</div>
            <h1 class="h4 fw-bold mb-4">Inscription</h1>

            <form class="d-grid gap-3" action="index.php?module=connexion&action=inscription" method="POST">
              <div>
                <label class="form-label">Email</label>
                <input type="email" class="form-control bg-light" name="login" required />
              </div>
              <div>
                <label class="form-label">Mot de passe</label>
                <input type="password" class="form-control bg-light" name="password" required />
              </div>
              <button class="btn btn-outline-pill w-75 mx-auto" type="submit">Créer le compte</button>
            </form>
            <p class="text-center text-muted small mt-4">
              Déjà inscrit? <a class="text-decoration-none" href="index.php?module=connexion">Connexion</a>.
            </p>
          </main>
        </div>';
    }

    function liste() {
        if (isset($_SESSION['login'])) {
            $this->affichage .= '
            <div class="mobile-wrap py-4">
              <main class="mobile-screen px-4 py-5 shadow-sm text-center">
                <div class="brand-title mb-4">E-BUVETTE</div>
                <h1 class="h5 fw-bold mb-3">Bienvenue</h1>
                <div class="info-panel mb-4">
                  <div class="d-flex justify-content-between">
                    <span>Connecté sous :</span>
                    <span>' . htmlspecialchars($_SESSION["login"]) . '</span>
                  </div>
                </div>
                <a class="btn btn-dark-pill w-75 mx-auto d-block" href="index.php?module=connexion&action=deconnexion">Déconnexion</a>
              </main>
            </div>';
        } else {
            $this->affichage .= '
            <div class="mobile-wrap py-4">
              <main class="mobile-screen px-4 py-5 shadow-sm text-center">
                <div class="brand-title mb-4">E-BUVETTE</div>
                <h1 class="h5 fw-bold mb-4">Accéder à votre espace</h1>
                <div class="d-grid gap-3">
                  <a class="btn btn-outline-pill w-75 mx-auto" href="index.php?module=connexion&action=connexion">Se connecter</a>
                  <a class="btn btn-outline-pill w-75 mx-auto" href="index.php?module=inscription">Créer un compte</a>
                </div>
              </main>
            </div>';
        }
    }

    function afficher() {
        echo $this->getAffichage();
    }
}
