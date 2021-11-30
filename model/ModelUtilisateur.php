<?php

/**
 * classe contenant les fonctions pour un utilisateur
 * Class ModelUtilisateur
 */
class ModelUtilisateur
{
    /**
     * Permet de valider ou non la recherche dans la base de donnée du pseudo et du mot de passe rentrés par l'utilisateur
     * @param string $pseudo pseudo de l'utilisateur
     * @param string $motDePasse motDePasse de l'utilisateur
     * @return bool
     */
    static function connexion(string $pseudo, string $motDePasse): bool
    {
        global $dsn, $login, $mdp;
        $gateway = new UtilisateurGateway(new Connexion($dsn, $login, $mdp));
        $pseudo = Nettoyage::NettoyageString($pseudo);
        $motDePasse = Nettoyage::NettoyageString($motDePasse);
        $result = $gateway->rechercherUtilisateur($pseudo, $motDePasse); //recherche si le pseudo et le mot de passe rentrés par l'utilisateur existent dans la base de données
        if ($result) { //Si le résultat est positif
            $_SESSION['role'] = 'utilisateur';
            $_SESSION['pseudo'] = $pseudo;
            return true;
        }
        return false;
    }

    /**
     * Permet de réintialiser la session et de ce fait déconnecter l'utilisateur
     */
    static function deconnexion()
    {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    /**
     * Permet de tester si le visiteur est connecté
     * @return bool
     */
    static function isUtilisateur(): bool
    {

        return (isset ($_SESSION['pseudo']) && isset($_SESSION['role']));
    }
}