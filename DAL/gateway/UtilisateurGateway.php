<?php


class UtilisateurGateway
{
    private $con;

    public function __construct($c)
    {
        $this->con = $c;
    }

    public function rechercherUtilisateur(string $pseudo, string $mdp): bool
    {
        $query = 'SELECT * FROM UTILISATEUR WHERE pseudo= :pseudo';
        $this->con->executeQuery($query, array(':pseudo' => array($pseudo, PDO::PARAM_STR)));
        if ($this->con->getCount() != 1) {
            return false;
        }

        $result = $this->con->getResults();
        return password_verify($mdp, $result[0]['motDePasse']);
    }


    public function supprimerUtilisateur($pseudo)
    {
        $query = 'DELETE FROM UTILISATEUR WHERE pseudo = :pseudo';
        $this->con->executeQuery($query, array(':pseudo' => array($pseudo, PDO::PARAM_STR)));
    }

    public function insererUtilisateur($pseudo, $motDePasse)
    {
        $query = 'INSERT INTO UTILISATEUR VALUES(:pseudo,:motDePasse)';
        $this->con->executeQuery($query, array(':pseudo' => array($pseudo, PDO::PARAM_STR), ':motDePasse' => array($motDePasse, PDO::PARAM_STR)));
    }
}