<?php
include_once "Connexion.php";

class ModeleBarman extends Connexion {
    public function getProduits($idAsso) {
        $query = self::getBdd()->prepare("SELECT idProduit as id, nom, prix FROM produit WHERE idAsso = ?");
        $query->execute([$idAsso]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduitById($id) {
        $query = self::getBdd()->prepare("SELECT idProduit as id, nom, prix FROM produit WHERE idProduit = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function enregistrerVente($idClient, $panier, $total, $idAsso) {
        $bdd = self::getBdd();
        try {
            $bdd->beginTransaction();

            $stmtCmd = $bdd->prepare("INSERT INTO commande (dateCommande, total, statut, type, IDCLIENT, idAsso) VALUES (NOW(), ?, 'Payé', 'Vente', ?, ?)");
            $stmtCmd->execute([$total, $idClient, $idAsso]);
            $idCommande = $bdd->lastInsertId();

            $stmtCont = $bdd->prepare("INSERT INTO contenir (idCommande, idProduit, quantite, prixUnitaire) VALUES (?, ?, ?, ?)");
            $stmtStock = $bdd->prepare("UPDATE produit SET stock = stock - ? WHERE idProduit = ?");

            foreach ($panier as $idProd => $item) {
                $stmtCont->execute([$idCommande, $idProd, $item['qte'], $item['prix']]);
                $stmtStock->execute([$item['qte'], $idProd]);
            }

            $stmtUser = $bdd->prepare("UPDATE utilisateur SET solde = solde - ? WHERE IDCLIENT = ?");
            $stmtUser->execute([$total, $idClient]);

            $bdd->commit();
            return true;
        } catch (Exception $e) {
            $bdd->rollBack();
            return false;
        }
    }
}