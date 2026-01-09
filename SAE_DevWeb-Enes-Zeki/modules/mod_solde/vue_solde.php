<?php
include_once "VueGenerique.php";

class VueSolde extends VueGenerique {
    public function afficherFormulaireRecharge() {
        echo "<h1>Ajouter du Solde</h1>
        <form action='index.php?module=solde&action=valider' method='POST'>
            <label>Montant (€) : </label>
            <input type='number' name='montant' step='0.01' required><br>
            <label>Moyen de paiement : </label>
            <select name='methode'>
                <option value='Espèces'>Espèces</option>
                <option value='CB'>Carte Bancaire</option>
            </select><br>
            <button type='submit'>Recharger</button>
        </form>";
    }

    public function afficherConfirmation($success) {
        if ($success) {
            echo "<p style='color:green;'>Compte rechargé avec succès !</p>";
        } else {
            echo "<p style='color:red;'>Erreur lors du rechargement.</p>";
        }
        echo "<a href='index.php'>Retour accueil</a>";
    }
}