<?php

//chargement config pour les variables globales
require_once(__DIR__ . "/config/Config.php");

// Chargement automatis√© pour pouvoir charger les classes √† chaque appel d'un "new"
require_once(__DIR__ . "/config/Autoload.php");

// appel de la fonction charger pour instancier
Autoload::charger();

//Lancement de la session
session_start();

$cont = new FrontControleur();