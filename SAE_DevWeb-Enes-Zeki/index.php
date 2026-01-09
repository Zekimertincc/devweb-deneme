<?php
session_start();
$_SESSION['idAsso'] = 1;

require_once 'Connexion.php';
require_once 'VueGenerique.php';
require_once 'composants/menu/ControllerMenu.php';
require_once 'composants/footer/ControllerFooter.php';

Connexion::initConnexion();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nom du Site</title>
</head>
<body>
<header>
    <h1>Nom du Site</h1>
    <?php
    $contM = new ControllerMenu();
    $contM->afficherMenu();
    ?>
</header>

<main>
    <?php
    $module = isset($_GET['module']) ? $_GET['module'] : "default";

    switch ($module) {
        case 'produit':
            include_once 'modules/mod_produit/mod_produit.php';
            new ModProduit();
            break;
        case 'connexion':
            include_once 'modules/mod_connexion/mod_connexion.php';
            new ModConnexion();
            break;
        case 'solde':
            include_once 'modules/mod_solde/mod_solde.php';
            new ModSolde();
            break;
        case 'barman': 
            include_once 'modules/mod_barman/mod_barman.php';
            new ModBarman();
            break;
        case 'inscription':
            include_once 'modules/mod_inscription/mod_inscription.php';
            new ModInscription();
            break;
        case 'inventaire':
            include_once 'modules/mod_inventaire/mod_inventaire.php';
            new ModInventaire();
            break;
        case 'profil':
            include_once 'modules/mod_profil/mod_profil.php';
            new ModProfil();
            break;
        case 'historique':
            include_once 'modules/mod_historique/mod_historique.php';
            new ModHistorique();
            break;  
        default:
            echo '<p>Bienvenue sur le site. Sélectionnez un module dans le menu pour commencer.</p>';
            break;
    }
    ?>
</main>

<footer>
    <?php
    $contF = new ControllerFooter();
    $contF->afficherFooter();
    ?>
</footer>
</body>
</html>