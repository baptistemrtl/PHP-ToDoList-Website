<?php

class FrontControleur
{
	public function __construct()
	{
		global $rep, $vues;

		try{
			//lancement de la session
			 session_start();
			 $listeActions = array(
	                'UtilisateurControleur' => array('Deconnexion', 'AjouterListePrivee', 'AfficherListeTachesPrivees', 'AjouterTitreListePrivee'),
	                'VisiteurControleur' => array(NULL, 'AfficherDetailListe', 'AjouterTache', 'AjouterTitreListePublique', 'AjouterListePublique', 'SupprimerTache', 'SupprimerListeTaches', 'AfficherConnexion', 'AfficherAide', 'Connexion','AfficherInscription','Inscription', 'UpdateTerminee'));
			

			$utilisateur = ModelUtilisateur::isUtilisateur();
			if (isset($_REQUEST['action'])) {
				$action=$_REQUEST['action'];
			}
			else
				$action = NULL;
			$ctrl = $this->rechAction($listeActions,$action,$utilisateur);
			if (!isset($ctrl)) {
				$Vueerreur[] = "action inconnue";
                require($rep . $vues['erreur']);
                exit(1);
			}
			new $ctrl;
		}
		catch(PDOException $ex){
			$Vueerreur[] = "Action " . $ex->getMessage();
			require($rep . $vues['erreur']);
		}

	}

	public function rechAction(array $listeActions, $action, bool $utilisateur){
		global $rep, $vues;
        foreach ($listeActions as $key => $value) {
            if (in_array($action, $value)) {
                if ($key == 'UtilisateurControleur') {
                    if (!$utilisateur) {
                        require($rep . $vues['connexion']);
                    }
                }
                return $key;
            }
        }
        return NULL;
	}

}