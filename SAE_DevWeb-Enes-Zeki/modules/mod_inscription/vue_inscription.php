<?php
class VueInscription {
    public function afficherFormulaire() {
        echo "<h2>Créer un compte</h2>
        <form action='index.php?module=inscription&action=valider' method='post'>
            <label>Nom :</label><input type='text' name='nom' required><br>
            <label>Prénom :</label><input type='text' name='prenom' required><br>
            <label>Email :</label><input type='email' name='email' required><br>
            <label>Mot de passe :</label><input type='password' name='password' required><br>
            <input type='hidden' name='csrf_token' value='" . $_SESSION['csrf_token'] . "'>
            <input type='submit' value='Créer le compte'>
        </form>";
    }

    public function afficherResultat($success) {
        if ($success) {
            echo "<p style='color:green;'>Compte créé avec succès !</p>";
        } else {
            echo "<p style='color:red;'>Erreur lors de la création.</p>";
        }
        echo "<a href='index.php'>Retour à l'accueil</a>";
    }
}