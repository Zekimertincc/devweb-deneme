<?php
include_once "VueGenerique.php";

class VueProduit extends VueGenerique
{
    public function affiche_liste($produits)
    {
        $rows = '';
        foreach ($produits as $produit) {
            $rows .= '
            <tr>
              <td>' . htmlspecialchars($produit['nom']) . '</td>
              <td>' . htmlspecialchars($produit['prix']) . '€</td>
              <td>' . htmlspecialchars($produit['stock']) . '</td>
              <td><a class="text-decoration-none" href="index.php?module=produit&action=details&id=' . $produit['idProduit'] . '">Détails</a></td>
            </tr>';
        }

        if ($rows === '') {
            $rows = '<tr><td colspan="4" class="text-muted">Aucun produit disponible.</td></tr>';
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

          <section class="card-soft p-4 mb-4">
            <h2 class="section-title h5 mb-3">Liste des produits</h2>
            <div class="table-responsive">
              <table class="table mb-0">
                <thead>
                  <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  ' . $rows . '
                </tbody>
              </table>
            </div>
          </section>

          <div class="d-flex justify-content-between">
            <a class="btn btn-outline-pill" href="index.php">Retour accueil</a>
            <a class="btn btn-dark-pill" href="index.php?module=produit&action=ajout">Ajouter un produit</a>
          </div>
        </main>';
    }

    public function affiche_details($produit)
    {
        if ($produit) {
            $this->affichage .= '
            <main class="container py-5 app-container">
              <section class="card-soft p-4 mb-4">
                <h2 class="section-title h5 mb-3">Détails du produit : ' . htmlspecialchars($produit['nom']) . '</h2>
                <ul class="list-unstyled mb-0">
                  <li><strong>Prix :</strong> ' . htmlspecialchars($produit['prix']) . ' €</li>
                  <li><strong>Stock actuel :</strong> ' . htmlspecialchars($produit['stock']) . '</li>
                  <li><strong>Seuil d\'alerte :</strong> ' . htmlspecialchars($produit['seuilAlert']) . '</li>
                  <li><strong>Catégorie :</strong> ' . htmlspecialchars($produit['categorie']) . '</li>
                </ul>
              </section>
              <a class="btn btn-outline-pill" href="index.php?module=produit&action=liste">Retour à la liste des produits</a>
            </main>';
        } else {
            $this->affichage .= '<div class="container py-5"><div class="alert alert-warning">Aucun produit trouvé.</div></div>';
        }
    }

    public function form_ajout()
    {
        $csrfToken = htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8');
        $this->affichage .= '
        <main class="container py-5 app-container">
          <section class="card-soft p-4 mb-4">
            <h2 class="section-title h5 mb-3">Ajouter un nouveau produit</h2>
            <form class="d-grid gap-3" action="index.php?module=produit&action=ajout" method="post">
              <div>
                <label class="form-label" for="nom">Nom du produit</label>
                <input type="text" name="nom" id="nom" class="form-control bg-light" required>
              </div>
              <div>
                <label class="form-label" for="prix">Prix (€)</label>
                <input type="number" step="0.01" name="prix" id="prix" class="form-control bg-light" required>
              </div>
              <div>
                <label class="form-label" for="stock">Stock initial</label>
                <input type="number" name="stock" id="stock" value="0" class="form-control bg-light" required>
              </div>
              <div>
                <label class="form-label" for="seuilAlert">Seuil d\'alerte stock</label>
                <input type="number" name="seuilAlert" id="seuilAlert" value="5" class="form-control bg-light" required>
              </div>
              <div>
                <label class="form-label" for="categorie">Catégorie</label>
                <input type="text" name="categorie" id="categorie" class="form-control bg-light" placeholder="Ex: Boisson, Snack">
              </div>
              <input type="hidden" name="csrf_token" value="' . $csrfToken . '">
              <button class="btn btn-dark-pill" type="submit">Enregistrer le produit</button>
            </form>
          </section>
          <a class="btn btn-outline-pill" href="index.php?module=produit&action=liste">Annuler et retourner à la liste</a>
        </main>';
    }

    public function affiche_confirmation()
    {
        $this->affichage .= '
        <div class="container py-5">
          <div class="alert alert-success">
            Le produit a été ajouté avec succès dans la base de données !
          </div>
          <a class="btn btn-outline-pill" href="index.php?module=produit&action=liste">Retour à la liste des produits</a>
        </div>';
    }

    public function afficher()
    {
        echo $this->getAffichage();
    }
}
