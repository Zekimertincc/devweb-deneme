<?php
include_once "VueGenerique.php";

class VueConnexion extends VueGenerique {
    function afficherFormulaireConnexion() {
        $this->affichage .= "<h1>Connexion</h1>
        <form action='index.php?module=connexion&action=connexion' method='POST'>
            <label for='login'>Identifiant :</label>
            <input type='text' id='login' name='login' required>
            <label for='password'>Mot de passe :</label>
            <input type='password' id='password' name='password' required>
            <button type='submit'>Confirmer</button>
        </form>";
    }

    function afficherFormulaireInscription() {
        $this->affichage .= "<h1>Inscription</h1>
        <form action='index.php?module=connexion&action=inscription' method='POST'>
            <label for='login'>Identifiant :</label>
            <input type='text' id='login' name='login' required>
            <label>Mot de passe :</label>
            <input type='password' name='password' required>
            <button type='submit'>Confirmer</button>
        </form>";
    }

    function liste() {
        if (isset($_SESSION['login'])) {
            $this->affichage .= '<p>Connecté sous : ' . htmlspecialchars($_SESSION["login"]) . '</p>';
            $this->affichage .= '<a href="index.php?module=connexion&action=deconnexion">Déconnexion</a>';
        } else {
            $this->affichage .= '<nav><ul>
                <li><a href="index.php?module=connexion&action=connexion">Se connecter</a></li>
                <li><a href="index.php?module=connexion&action=inscription">Inscription</a></li>
            </ul></nav>';
        }
    }

    function afficher() {
        echo $this->getAffichage();
    }
}