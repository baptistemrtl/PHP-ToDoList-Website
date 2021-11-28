<?php


class TacheGateway
{
    private $con;

    public function __construct($c)
    {
        $this->con = $c;
    }

    /**
     * Permet la récupération de toutes les tâches d'une liste par son IDListe
     * @param int $idListeTaches id de la liste de tâches
     * @return array
     */
    public function getAllTachesByIdListeTaches(int $idListeTaches)
    {
        $query = 'SELECT * FROM TACHE where idListeTaches=:idListeTaches order by idTache';
        $tab=array();
        $this->con->executeQuery($query, array(':idListeTaches' => array($idListeTaches, PDO::PARAM_INT)));
        $results = $this->con->getResults();
        foreach($results as $row){
            $tab[] = new Tache($row['idTache'],$row['nom'],$row['terminee'],$row['idListeTaches']);
        }
        return $tab;
    }

    /**
     * Permet l'insertion d'une Tâche dans une liste grâce à son IDListe
     * @param string $nom nom de la tâche à ajouter
     * @param bool $terminee booleen permettant de signifier si la tâche est finie ou non
     * @param int $idListeTaches ID de la liste de tâches
     */
    public function insertTache(string $nom, bool $terminee, int $idListeTaches)
    {
        $query = 'Insert into Tache values(NULL, :nom, :terminee, :idListeTaches )';
        $this->con->executeQuery($query, array(':nom' => array($nom, PDO::PARAM_STR),
            ':terminee' => array($terminee, PDO::PARAM_INT), ':idListeTaches' => array($idListeTaches, PDO::PARAM_INT)));
    }

    /** Permet la suppression d'une tâche par son IDTache
     * @param int $idTache id de la tâche à supprimer
     */
    public function deleteTachebyIdTache(int $idTache)
    {
        $query = 'DELETE FROM Tache where idTache=:idTache';
        $this->con->executeQuery($query, array(':idTache' => array($idTache, PDO::PARAM_INT)));
    }

    /** Permet la suppression des tâches d'une liste grâce à l'IDListe
     * @param int $idListeTaches
     */
    public function deleteTachesByIdListeTaches(int $idListeTaches)
    {
        $query = 'DELETE FROM Tache where idListeTaches=:idListeTaches';
        $this->con->executeQuery($query, array(':idListeTaches' => array($idListeTaches, PDO::PARAM_INT)));
    }

    /** Permet la récupération d'une tâche par son ID
     * @param int $idTache id de la tâche à récupérer
     * @return Tache
     */
    public function getTacheByIdTache(int $idTache)
    {
        $query = 'SELECT * FROM Tache where idTache=:idTache';
        $this->con->executeQuery($query, array(':idTache' => array($idTache, PDO::PARAM_INT)));
        $res = $this->con->getResult();
        return new Tache($results[0]['idTache'],$results[0]['nom'],$results[0]['terminee'],$results[0]['idListeTaches']);
    }

    /** Permet de modifier le statut de la tâche (fini ou non)
     * @param int $idTache id de la tâche dont le statut doit être modifié
     * @param bool $terminee booleen permettant de signifier si la tâche est finie ou non
     */
    public function UpdateTerminee(int $idTache, bool $terminee)
    {
        $query = 'UPDATE Tache set terminee=:terminee where idTache=:idTache';
        $this->con->executeQuery($query, array(':idTache' => array($idTache, PDO::PARAM_INT), ':terminee' => array($terminee, PDO::PARAM_BOOL)));
    }

    /** Permet de retourner le nombre de tâches de toutes les listes
     * @return mixed
     */
    public function nbTache()
    {
        $query = 'SELECT count(*) FROM Tache';
        $this->con->executeQuery($query, array());
        $results = $this->con->getResults();
        return $results[0]["count(*)"];
    }
}