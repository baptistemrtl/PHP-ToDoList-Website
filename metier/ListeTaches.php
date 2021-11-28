<?php

/**
 * classe métier d'une liste de tâches
 * Class ListeTaches
 */
class ListeTaches
{
    private $idListeTaches;
    private $nom;
    private $listeDeTaches;
    private $confidentialite;
    private $description;

    public function __construct(int $idListeTaches, string $nom, bool $confidentialite, string $description)
    {
        $this->setIdListeTaches($idListeTaches);
        $this->setNom($nom);
        $this->setConfidentialite($confidentialite);
        $this->setDescription($description);
    }

    /**
     * @return mixed
     */
    public function getIdListeTaches()
    {
        return $this->idListeTaches;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getConfidentialite()
    {
        return $this->confidentialite;
    }

    /**
     * @return mixed
     */
    public function getListeTaches()
    {
        return $this->listeDeTaches;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $idListeTaches
     */
    public function setIdListeTaches($idListeTaches)
    {
        $this->idListeTaches = $idListeTaches;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param mixed $confidentialite
     */
    public function setConfidentialite($confidentialite)
    {
        $this->confidentialite = $confidentialite;
    }

    /**
     * @param mixed $listeDeTaches
     */
    public function setListeTaches($listeDeTaches)
    {
        $this->listeDeTaches = $listeDeTaches;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}