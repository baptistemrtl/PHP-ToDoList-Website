<?php


class UtilisateurGateway
{
    private $con;

    public function __construct($c)
    {
        $this->con = $c;
    }

    /**
     * Permet de savoir si un utilisateur est présent dans la base de données
     * @param string $pseudo pseudo de l'utilisateur
     * @param string $mdp mot de passe de l'utilisateur
     * @return bool
     */
    public function rechercherUtilisateur(string $pseudo, string $mdp): bool
    {
        $query = 'SELECT * FROM Utilisateur WHERE pseudo= :pseudo';
        $this->con->executeQuery($query, array(':pseudo' => array($pseudo, PDO::PARAM_STR)));
        if ($this->con->getCount() != 1) {
            return false;
        }

        $result = $this->con->getResults();
        return password_verify($mdp, $result[0]['motDePasse']);
        //return $mdp == $result[0]['motDePasse'];
    }

    /**
     * Permet de savoir si un pseudo est déjà utilisé par un utilisateur
     * @param string $pseudo pseudo de l'utilisateur
     * @return bool
     */
    public function findUtilisateurbyPseudo(string $pseudo) : bool
    {
        $query = 'SELECT * FROM Utilisateur WHERE pseudo= :pseudo';
        $this->con->executeQuery($query, array(':pseudo' => array($pseudo, PDO::PARAM_STR)));
        if ($this->con->getCount() != 1) {
            return false;
        }
        return true;
    }

    /**
     * Permet de supprimer un utilisateur de la base de données
     * @param string $pseudo pseudo de l'utilisateur
     */
    public function supprimerUtilisateur($pseudo)
    {
        $query = 'DELETE FROM Utilisateur WHERE pseudo = :pseudo';
        $this->con->executeQuery($query, array(':pseudo' => array($pseudo, PDO::PARAM_STR)));
    }

    /**
     * Permet d'insérer un utilisateur dans la base de données
     * @param string $pseudo pseudo de l'utilisateur
     * @param string $mdp mot de passe de l'utilisateur
     */
    public function insererUtilisateur($pseudo, $motDePasse)
    {
        $query = 'INSERT INTO Utilisateur VALUES(:pseudo,:motDePasse)';
        $this->con->executeQuery($query, array(':pseudo' => array($pseudo, PDO::PARAM_STR), ':motDePasse' => array(password_hash($motDePasse,PASSWORD_DEFAULT), PDO::PARAM_STR)));
    }
}