<?php
require_once 'Connexion.php';

class ModeleInscription extends Connexion {
    public function inscrireUtilisateur($data) {
        $bdd = self::getBdd();
        $hashPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $query = $bdd->prepare("INSERT INTO utilisateur (NOM, PRENOM, email, MOTDEPASSE, solde) VALUES (?, ?, ?, ?, 0)");
        return $query->execute([
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $hashPassword
        ]);
    }
}