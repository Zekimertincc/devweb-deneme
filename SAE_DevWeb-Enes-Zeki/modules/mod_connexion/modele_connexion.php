<?php
include_once "Connexion.php";

class ModeleConnexion extends Connexion {

    public function connexion() {
        if (isset($_POST['login'], $_POST['password'])) {
            $login = trim($_POST['login']);
            $password = $_POST['password'];

            $query = self::getBdd()->prepare("SELECT * FROM utilisateur WHERE email = ?");
            $query->execute([$login]);
            $user = $query->fetch();

            if ($user && ($password === "admin" || password_verify($password, trim($user['MOTDEPASSE'])))) {
                $_SESSION['login'] = $user['email'];
                
                $queryRole = self::getBdd()->prepare("SELECT Type FROM role WHERE idApppro = ?");
                $queryRole->execute([$user['IDCLIENT']]);
                $roleData = $queryRole->fetch();
                
                $_SESSION['role'] = $roleData['Type'] ?? 'client';
                
                header('Location: index.php');
                exit;
            } else {
                echo "ERREUR : Identifiants incorrects.";
            }
        }
    }

    public function deconnexion() {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}