<?php
include_once "Connexion.php";

class ModeleSolde extends Connexion {
    public function rechargerCompte($idClient, $montant, $methode) {
        $bdd = self::getBdd();
        try {
            $bdd->beginTransaction();

            $stmt1 = $bdd->prepare("UPDATE utilisateur SET solde = solde + ? WHERE IDCLIENT = ?");
            $stmt1->execute([$montant, $idClient]);

            $stmt2 = $bdd->prepare("INSERT INTO recharge (montant, moyenPaiement, IDCLIENT) VALUES (?, ?, ?)");
            $stmt2->execute([$montant, $methode, $idClient]);

            $bdd->commit();
            return true;
        } catch (Exception $e) {
            $bdd->rollBack();
            return false;
        }
    }
}