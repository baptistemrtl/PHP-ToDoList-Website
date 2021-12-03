<?php

/**
 * Contient les fonctions pour les actions d'un utilisateur
 * Class UtilisateurControleur
 */
class UtilisateurControleur extends VisiteurControleur
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
                case "AfficherListeTachesPrivees":
                    $this->AfficherListeTachesPrivees();
                    break;
                case "Deconnexion":
                    $this->Deconnexion();
                    break;
                case "AjouterListePrivee":
                    $this->AjouterListePrivee();
                    break;
                case "AjouterTitreListePrivee":
                    $this->AjouterTitreListePrivee();
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
     * Affiche les listes des tâches privés dans la page vueListesPrivees. Il faut que l'utilisateur soit connecté au préalable.
     */
    function AfficherListeTachesPrivees()
    {
        global $rep, $vues, $tacheMax;
        if (ModelUtilisateur::isUtilisateur()) { //Teste si l'utilisateur est connecté
            $pseudo = $_SESSION['pseudo'];
            $tabListeTaches = ModelListeTaches::getAllListeTachesByPseudo($pseudo); //Récupère toutes les listes de tâches par le pseudo
            foreach ($tabListeTaches as $liste) {
                $liste->setListeTaches(ModelTache::getAllTachesByIdListeTaches($liste->getIdListeTaches())); // récupération et remplissage de toutes les taches associées à chaque liste
            }
            require($rep . $vues['vueListesPrivees']);
        }
    }

    /**
     * Permet la déconnexion d'un utilisateur étant préalablement connecté
     */
    function Deconnexion()
    {
        ModelUtilisateur::deconnexion();
        header('Refresh:0;url=index.php');
    }

    /**
     * Permet l'ajout d'une liste privée
     */
    function AjouterListePrivee()
    {
        $privee = true;// confidentialite de la liste
        $nomListe = Nettoyage::NettoyageString($_REQUEST['nomListe']);
        $description = Nettoyage::NettoyageString($_REQUEST['description']);
        $pseudo = $_SESSION['pseudo']; //Récupère le pseudo de l'utilisateur permettant l'ajout de sa liste privée
        if (Validation::ValidationString($description)) {
            ModelListeTaches::insertListeTaches($nomListe, $privee, $description, $pseudo); //Insère la liste de taches pour un pseudo défini
            header('Refresh:0;url=index.php');
        } else { //Si pas de description valide
            ModelListeTaches::insertListeTaches($nomListe, $privee, "La liste n'a pas de description", $pseudo);
            header('Refresh:0;url=index.php');
        }

    }

    /**
     * Permet de se déplacer vers la vue ajoutDescriptionListe dans la partie privée et de récupérer le nom de la liste privée
     */
    function AjouterTitreListePrivee()
    {
        $privee = true;// confidentialite de la liste
        global $rep, $vues;
        $nomListe = Nettoyage::NettoyageString($_REQUEST['nomListe']); //Nettoie le nom de la liste ajoutée
        if (Validation::ValidationString($nomListe)) {
            require($rep . $vues['ajoutDescriptionListe']);
        } else { //Si le nom de la liste n'est pas valide
            $Vueerreur[] = "Le nom de la liste ne peut pas contenir des balises";
            require($rep . $vues['erreur']);
            header('Refresh:2;url=index.php?action=AfficherListeTachesPrivees');
        }
    }


}