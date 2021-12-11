<?php


class Utilisateur
{
    private $pseudo;

    public function __construct(string $pseudo)
    {
        $this->setPseudo($pseudo);
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

}