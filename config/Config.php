<?php

// général pour trouver dossier
$rep = __DIR__ . '/../';

// variable pour le nombre de tache maximum visible sur page d'accueil
$tacheMax = 3;

//BD
$dsn = 'mysql:host=localhost;dbname=todolist;charset=utf8';
$base = "todolist";
$login = "usertdl";
$mdp = "OR7M07rEmwW9lq5F";

//Vues
$vues['erreur'] = 'vues/vueErreur.php';
$vues['accueil'] = 'vues/vueAccueil.php';
$vues['vueDetailListe'] = 'vues/vueDetailListe.php';
$vues['connexion'] = 'vues/vueConnexion.php';
$vues['vueListesPrivees'] = 'vues/vueListesPrivees.php';
$vues['ajoutDescriptionListe'] = 'vues/vueAjoutDescriptionListe.php';
$vues['inscription'] = 'vues/vueInscription.php';

