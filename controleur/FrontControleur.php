<?php

class FrontControleur
{
	public function __construct()
	{
		global $rep, $vues;

		try{
			
			 //Déclaration d'un tableau d'actions Key -> controleurs; Value -> actions
			 $listeActions = array(
	                'UtilisateurControleur' => array('Deconnexion', 'AjouterListePrivee', 'AfficherListeTachesPrivees', 'AjouterTitreListePrivee'),
	                'VisiteurControleur' => array(NULL, 'AfficherDetailListe', 'AjouterTache', 'AjouterTitreListePublique', 'AjouterListePublique', 'SupprimerTache', 'SupprimerListeTaches', 'AfficherConnexion', 'AfficherAide', 'Connexion','AfficherInscription','Inscription', 'UpdateTerminee'));
			
			$utilisateur = ModelUtilisateur::isUtilisateur(); //Savoir si l'utilisateur est connecté
			if (isset($_REQUEST['action'])) { 
				$action=$_REQUEST['action'];
			}
			else
				$action = NULL;
			$ctrl = $this->findAction($listeActions,$action,$utilisateur); //Cherche le controleur adéquat pour l'action $action
			if (!isset($ctrl)) { //si il n'y a pas de controleur
				$Vueerreur[] = "action inconnue";
                require($rep . $vues['erreur']);
                exit(1);
			}
			new $ctrl; //instanciation du controleur
		}
		catch(PDOException $ex){
			$Vueerreur[] = "Action " . $ex->getMessage();
			require($rep . $vues['erreur']);
		}

	}

	/**
	 *Fonction qui cherche le controleur adéquat à une action donné
	 * @param array $listeActions dictionnaire d'actions
	 * @param $action action dont on doit trouver le contrôleur (peut être NULL)
	 * @param bool $utilisateur internaute connecté ou non
	 * @return string ou NULL
	 */
	public function findAction(array $listeActions, $action, bool $utilisateur){
		global $rep, $vues;
        foreach ($listeActions as $key => $value) {
            if (in_array($action, $value)) { //si l'action existe
                if ($key == 'UtilisateurControleur') { 
                    if (!$utilisateur) {
                        require($rep . $vues['connexion']); //empêche d'accéder à des actions d'utilisateurs en étant visiteur 
                    }
                }
                return $key;
            }
        }
        return NULL; //si l'action n'existe pas
	}

}