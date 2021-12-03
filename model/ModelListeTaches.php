<?php

/**
 * classe contenant les fonctions pour une liste de tâches
 * Class ModelListeTaches
 */
class ModelListeTaches
{
    /**
     * Permet de récupérer une liste de tâche en fonction d'un idListe
     * @param int $idListeTache id de la liste voulue
     * @return ListeTaches
     */
    static function getListeTachesbyID(int $idListeTache)
    {
        global $dsn, $login, $mdp;
        $gateway = new ListeTachesGateway(new Connexion($dsn, $login, $mdp));
        $result = $gateway->getListeTachesbyID($idListeTache);
        return $results;
    }

    /**
     * Permet de récupérer toutes les listes de tâches publiques
     * @return array
     */
    static function getAllListeTachesPublic(): array
    {
        global $dsn, $login, $mdp;
        $tabN = array();
        $gateway = new ListeTachesGateway(new Connexion($dsn, $login, $mdp));
        $results = $gateway->getAllListeTachesPublic();
        return $results;
    }

    /**
     * Permet de récupérer les listes de tâches propres à un utilisateur
     * @param string $pseudo pseudo de l'utilisateur
     * @return array
     */
    static function getAllListeTachesByPseudo(string $pseudo): array
    {
        global $dsn, $login, $mdp;
        $tabN = array();
        $gateway = new ListeTachesGateway(new Connexion($dsn, $login, $mdp));
        $results = $gateway->getAllListeTachesByPseudo($pseudo);
        return $results;
    }

    /**
     * Permet d'ajouter une liste
     * @param string $nom nom de la liste
     * @param bool $confidentialite liste privée ou non
     * @param string $description description de la liste
     * @param $pseudo // pseudo de l'utilisateur ou NULL si liste publique
     */
    static function insertListeTaches(string $nom, bool $confidentialite, string $description, $pseudo)
    {
        global $dsn, $login, $mdp;
        $gateway = new ListeTachesGateway(new Connexion($dsn, $login, $mdp));
        $gateway->insertListeTaches($nom, $confidentialite, $description, $pseudo);
    }

    /**
     * Permet de supprimer une liste et ses tâches associées
     * @param int $idListeTaches id de la liste à supprimer
     */
    static function deleteListeTaches(int $idListeTaches)
    {
        global $dsn, $login, $mdp;
        $gateway = new ListeTachesGateway(new Connexion($dsn, $login, $mdp));
        ModelTache::deleteTachesByIdListeTaches($idListeTaches); // suppression de toutes les tâches de la liste
        $gateway->deleteListeTaches($idListeTaches); // suppression de la liste
    }

    /**
     * Permet de récupérer le nombre de liste de taches
     * @return mixed
     */
    static function getNombreDeListeTache()
    {
        global $dsn, $login, $mdp;
        $gateway = new ListeTachesGateway(new Connexion($dsn, $login, $mdp));
        $results = $gateway->nbListeTaches();
        return $results[0]["count(*)"];
    }

}