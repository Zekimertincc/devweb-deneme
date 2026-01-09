<?php
include_once "VueGenerique.php";

class VueInventaire extends VueGenerique {
    public function afficherInventaire($produits, $nbAlertes) {
        $totalProduits = count($produits);
        $alertes = (int) $nbAlertes;

        $rows = '';
        foreach ($produits as $p) {
            $isCritical = ($p['stock'] <= $p['seuilAlert']);
            $rows .= '
            <tr>
              <td>' . htmlspecialchars($p['nom']) . '</td>
              <td>' . htmlspecialchars($p['stock']) . '</td>
              <td>' . htmlspecialchars($p['seuilAlert']) . '</td>
              <td>' . ($isCritical ? '<span class="text-danger fw-semibold">Commander</span>' : 'RAS') . '</td>
            </tr>';
        }

        $this->affichage .= '
        <main class="container py-5 app-container">
          <header class="header-bar d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div class="brand-title">E-BUVETTE</div>
            <nav class="d-flex gap-4 fw-semibold">
              <a class="nav-link p-0" href="index.php?module=produit">Produits</a>
              <a class="nav-link p-0" href="index.php?module=inventaire">Inventaire</a>
              <a class="nav-link p-0" href="index.php?module=historique">Rapports</a>
              <a class="nav-link p-0" href="index.php?module=connexion&action=deconnexion">Deconnexion</a>
            </nav>
          </header>

          <section class="row g-4 mb-4">
            <div class="col-md-3">
              <div class="card-soft stat-card d-flex flex-column justify-content-center text-center p-3">
                <div class="text-muted">Produits</div>
                <div class="fs-4 fw-bold">' . $totalProduits . '</div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card-soft stat-card d-flex flex-column justify-content-center text-center p-3">
                <div class="text-muted">Produits en alerte</div>
                <div class="fs-4 fw-bold">' . $alertes . '</div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card-soft stat-card d-flex flex-column justify-content-center text-center p-3">
                <div class="text-muted">Trésorerie</div>
                <div class="fs-4 fw-bold">1200€</div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card-soft stat-card d-flex flex-column justify-content-center text-center p-3">
                <div class="text-muted">Ventes du jour</div>
                <div class="fs-4 fw-bold">200€</div>
              </div>
            </div>
          </section>

          <section class="card-soft p-4 mb-4">
            <h2 class="section-title h5 mb-3">Produits en alerte stock bas</h2>
            <div class="table-responsive">
              <table class="table mb-0">
                <thead>
                  <tr>
                    <th>Produit</th>
                    <th>Stock</th>
                    <th>Seuil</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  ' . ($rows ?: '<tr><td colspan="4" class="text-muted">Aucun produit en stock.</td></tr>') . '
                </tbody>
              </table>
            </div>
          </section>

          <section class="row g-4 align-items-center">
            <div class="col-md-5">
              <div class="card-soft graph-placeholder">graph vente</div>
            </div>
            <div class="col-md-7 d-flex justify-content-md-end">
              <a class="btn btn-dark-pill" href="index.php?module=produit&action=ajout">Ajouter un produit</a>
            </div>
          </section>
        </main>';
    }

    public function afficher() {
        echo $this->getAffichage();
    }
}
