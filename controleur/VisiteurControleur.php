<?php

/**
 * Contient les fonctions pour les actions des visiteurs
 * Class VisiteurControleur
 */
class VisiteurControleur
{
    function __construct()
    {
        global $rep, $vues;

        $Vueerreur = array();
        try {
            if (isset($_REQUEST["action"])) {
                $action = $_REQUEST["action"];
            } else {
                $action = NULL;
            }

            switch ($action) {

                //pas d'action, on réinitialise 1er appel
                case NULL:
                    $this->Reinit();
                    break;
                case "AfficherDetailListe":
                    $this->AfficherDetailListe();
                    break;
                case "AjouterTache":
                    $this->AjouterTache();
                    break;
                case "AjouterTitreListePublique":
                    $this->AjouterTitreListePublique();
                    break;
                case "AjouterListePublique":
                    $this->AjouterListePublique();
                    break;
                case "SupprimerTache":
                    $this->SupprimerTache();
                    break;
                case "SupprimerListeTaches":
                    $this->SupprimerListeTaches();
                    break;
                case "UpdateTerminee":
                    $this->UpdateTerminee();
                    break;
                case "Connexion":
                    $this->Connexion();
                    break;
                case "AfficherConnexion":
                    $this->AfficherConnexion();
                    break;
                case "AfficherInscription":
                    $this->AfficherInscription();
                    break;
                default:
                    $Vueerreur[] = "Erreur d'appel, l'action est inconnue";
                    require($rep . $vues['erreur']);
                    break;
            }
        } catch (PDOException $e) {
            $Vueerreur[] = $e->getMessage();;
            require($rep . $vues['erreur']);

        } catch (Exception $e2) {
            $Vueerreur[] = $e2->getMessage();;
            require($rep . $vues['erreur']);
        }
    }

    /**
     * Permet de charger toutes les listes publiques lors du lancement de la page d'accueil
     */
    function Reinit()
    {
        global $rep, $vues, $tacheMax;
        $tabListeTaches = ModelListeTaches::getAllListeTachesPublic(); // récupération de toutes les listes publiques
        foreach ($tabListeTaches as $liste) {
            $liste->setListeTaches(ModelTache::getAllTachesByIdListeTaches($liste->getIdListeTaches())); // récupération et remplissage de toutes les taches associées à chaque liste
        }
        require($rep . $vues['accueil']);
    }

    /**
     * Permet d'afficher une liste sur laquelle le visiteur ou utilisateur aura cliqué
     */
    function AfficherDetailListe()
    {
        global $rep, $vues;
        $idListeTaches = $_REQUEST['idListeTaches'];
        $listetaches = ModelListeTaches::getListeTachesbyID($idListeTaches); // récupération de la liste voulue
        $listetaches->setListeTaches(ModelTache::getAllTachesByIdListeTaches($listetaches->getIdListeTaches()));// récupération et remplissage de toutes les taches associées à la liste voulue
        require($rep . $vues['vueDetailListe']);
    }

    /**
     * Permet d'ajouter une tache à la liste voulue
     */
    function AjouterTache()
    {
        global $rep, $vues;
        $NomTache = Nettoyage::NettoyageString($_REQUEST['NomTache']);
        $idListeTaches = $_REQUEST['idListeTaches'];
        if (Validation::ValidationString($NomTache)) { // si nom de la tache valide
            ModelTache::insertTache($NomTache, false, $idListeTaches); // ajout de la tache
            header('Refresh:0;url=index.php?action=AfficherDetailListe&idListeTaches=' . $idListeTaches);
        } else {
            $Vueerreur[] = "Le nom de la tache ne peut pas contenir des balises";
            require($rep . $vues['erreur']);
            header('Refresh:2;url=index.php?action=AfficherDetailListe&idListeTaches=' . $idListeTaches);
        }

    }

    /**
     * Permet de récupérer le nom de la liste publique et d'emmener sur la page d'ajout de description
     */
    function AjouterTitreListePublique()
    {
        $privee = false;// confidentialite de la liste
        global $rep, $vues;
        $nomListe = Nettoyage::NettoyageString($_REQUEST['nomListe']);
        if (Validation::ValidationString($nomListe)) { // si nom de la liste valide
            require($rep . $vues['ajoutDescriptionListe']);
        } else {
            $Vueerreur[] = "Le nom de la liste ne peut pas contenir des balises";
            require($rep . $vues['erreur']);
            header('Refresh:2;url=index.php');
        }

    }

    /**
     * Permet d'ajouter une liste publique à la base de données
     */
    function AjouterListePublique()
    {
        $privee = false; // confidentialite de la liste
        $pseudo = NULL; // liste publique donc pseudo égal à NULL

        $nomListe = Nettoyage::NettoyageString($_REQUEST['nomListe']);
        $description = Nettoyage::NettoyageString($_REQUEST['description']);
        if (Validation::ValidationString($description)) { // si la description n'est pas vide
            ModelListeTaches::insertListeTaches($nomListe, $privee, $description, $pseudo);
            $this->Reinit();
        } else {
            ModelListeTaches::insertListeTaches($nomListe, $privee, "La liste n'a pas de description", $pseudo);
            $this->Reinit();
        }

    }

    /**
     * Permet de supprimer une tache d'une liste
     */
    function SupprimerTache()
    {
        $IdTache = $_REQUEST['idTache'];
        $idListeTaches = ModelTache::getTacheByIdTache($IdTache)->getIdListeTaches();
        ModelTache::deleteTachebyIdTache($IdTache);
        header('Refresh:0;url=index.php?action=AfficherDetailListe&idListeTaches=' . $idListeTaches);
    }

    /**
     * Permet de supprimer une liste de taches
     */
    function SupprimerListeTaches()
    {
        $IdlisteTache = $_REQUEST['idListeTaches'];
        ModelListeTaches::deleteListeTaches($IdlisteTache);
        $this->Reinit();
    }

    /**
     * Permet de changer le statut de la tache, si elle est terminée ou non
     */
    function UpdateTerminee()
    {
        $checked = $_REQUEST['UpdateTerminee'];
        $idTache = $_REQUEST['idTache'];
        $idListeTaches = ModelTache::getTacheByIdTache($idTache)->getIdListeTaches(); // récupération de l'id de la liste dans laquelle la tache a été mise à jour pour rester sur la même page
        ModelTache::UpdateTerminee($idTache, $checked);
        header('Refresh:0;url=index.php?action=AfficherDetailListe&idListeTaches=' . $idListeTaches);
    }

    /**
     * Permet la connexion d'un visiteur
     */
    function Connexion()
    {
        global $rep, $vues;
        $pseudo = $_REQUEST['pseudo'];
        $mdp = $_REQUEST['mdp'];
        $data = array();
        $Vueerreur = Validation::ValidationConnexion($pseudo, $mdp); // vérification que les données sont valides
        if (empty($Vueerreur)) { // si valides
            if (ModelUtilisateur::connexion($pseudo, $mdp)) { // si l'utilisateur est dans la base de données
                $data[] = "Connexion réussie !"; // valeur affichée dans la vue
                header('Refresh:1;url=index.php');
            } else {
                $data[] = "Problème de connexion ! Le pseudo ou mot de passe est incorrect !"; // erreur de type pseudo ou mdp incorrect valeur affichée dans la vue
            }
        } else {
            require($rep . $vues['erreur']); // erreur de type injection affichée dans la vue d'erreur
            header('Refresh:2;url=index.php?action=AfficherConnexion');
        }
        sleep(1); // attente pour afficher bandeau statut connexion
        require($rep . $vues['connexion']);
    }

    /**
     * Permet d'afficher la vue de connexion
     */
    function AfficherConnexion()
    {
        global $rep, $vues;
        require($rep . $vues['connexion']);
    }

    /**
     * Permet d'afficher la vue d'inscription
     */

    function AfficherInscription()
    {
        global $rep, $vues;
        require($rep . $vues['inscription']);
    }


}