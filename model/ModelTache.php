<?php

/**
 * classe contenant les fonctions pour une tache
 * Class ModelTache
 */
class ModelTache
{
    /**
     * Permet la récupération de toutes les tâches d'une liste par son IDListe
     * @param int $idListeTaches id de la liste de tâches
     * @return array
     */
    static function getAllTachesByIdListeTaches(int $idListeTaches):array
    {
        global $dsn, $login, $mdp;
        $tabN = array();
        $gateway = new TacheGateway(new Connexion($dsn, $login, $mdp));
        $results = $gateway->getAllTachesByIdListeTaches($idListeTaches);
        foreach ($results as $row) {
            $tabN[] = new Tache($row['idTache'], $row['nom'], $row['terminee'], $row['idListeTaches']);
        }
        return $tabN;
    }

    /**
     * Permet l'insertion d'une Tâche dans une liste grâce à son IDListe
     * @param string $nom nom de la tâche à ajouter
     * @param bool $terminee booleen permettant de signifier si la tâche est finie ou non
     * @param int $idListeTaches ID de la liste de tâches
     */
    static function insertTache(string $nom, bool $terminee, int $idListeTaches)
    {
        global $dsn, $login, $mdp;
        $gateway = new TacheGateway(new Connexion($dsn, $login, $mdp));
        $gateway->insertTache($nom, $terminee, $idListeTaches);
    }

    /** Permet la suppression d'une tâche en fonction d'un IDTache
     * @param int $idTache id de la tâche à supprimer
     */
    static function deleteTachebyIdTache(int $idTache)
    {
        global $dsn, $login, $mdp;
        $gateway = new TacheGateway(new Connexion($dsn, $login, $mdp));
        $gateway->deleteTachebyIdTache($idTache);
    }

    /** Permet la suppression des tâches d'une liste grâce à l'IDListe (est appelée dans la fonction deleteListeTaches de modelListetache)
     * @param int $idListeTaches
     */
    static function deleteTachesByIdListeTaches(int $idListeTaches)
    {
        global $dsn, $login, $mdp;
        $gateway = new TacheGateway(new Connexion($dsn, $login, $mdp));
        $gateway->deleteTachesByIdListeTaches($idListeTaches);
    }

    /** Permet la récupération d'une tâche par son ID
     * @param int $idTache  id de la tâche à récupérer
     * @return Tache
     */
    static function getTacheByIdTache(int $idTache){
        global $dsn, $login, $mdp;
        $gateway = new TacheGateway(new Connexion($dsn, $login, $mdp));
        $result = $gateway->getTacheByIdTache($idTache);
        return new Tache($result['idTache'], $result['nom'], $result['terminee'], $result['idListeTaches']);
    }

    /** Permet de modifier le statut de la tâche (fini ou non)
     * @param int $idTache id de la tâche dont le statut doit être modifié
     * @param $terminee //booleen permettant de signifier si la tâche est finie ou non
     */
    static function UpdateTerminee(int $idTache, $terminee)
    {
        global $dsn, $login, $mdp;
        $gateway = new TacheGateway(new Connexion ($dsn, $login, $mdp));
        if(!$terminee){
            $gateway->UpdateTerminee($idTache, 0);
        }
        else $gateway->UpdateTerminee($idTache, 1);
    }

    /** Permet de retourner le nombre de tâches de toutes les listes
     * @return mixed
     */
    static function getNombreDeTache()
    {
        global $dsn, $login, $mdp;
        $gateway = new TacheGateway(new Connexion($dsn, $login, $mdp));
        return $gateway->nbTache();
    }
}