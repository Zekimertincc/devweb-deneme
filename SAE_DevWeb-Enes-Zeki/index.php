<?php
session_start();
$_SESSION['idAsso'] = 1;

require_once 'Connexion.php';
require_once 'VueGenerique.php';
require_once 'composants/layout.php';
require_once 'composants/menu/ControllerMenu.php';
require_once 'composants/footer/ControllerFooter.php';

Connexion::initConnexion();

$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$baseUrl = ($scriptDir === '' || $scriptDir === '.') ? '/public' : $scriptDir . '/public';
define('BASE_URL', $baseUrl);
?>
<?php
renderLayoutHeader('E-BUVETTE');
?>
<header class="container py-3">
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
            echo '<div class="container py-4"><div class="card-soft p-4">Bienvenue sur le site. Sélectionnez un module dans le menu pour commencer.</div></div>';
            break;
    }
    ?>
</main>

<footer class="container py-4">
    <?php
    $contF = new ControllerFooter();
    $contF->afficherFooter();
    ?>
</footer>
<?php
renderLayoutFooter();
?>
