<?php

//chargement config pour les variables globales
require_once(__DIR__ . '/config/config.php');

// Chargement automatisé pour pouvoir charger les classes à chaque appel d'un "new"
require_once(__DIR__ . '/config/Autoload.php');

// appel de la fonction charger pour instancier
Autoload::charger();

//$cont = new FrontControleur();