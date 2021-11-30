<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link type="text/css" href="style/header.css" rel="stylesheet" media="all">
    <link type="text/css" href="style/accueil.css" rel="stylesheet" media="all">
    <link type="text/css" href="style/vueDetailListe.css" rel="stylesheet" media="all">
    <link type="text/css" href="style/ajoutDescription.css" rel="stylesheet" media="all">
    <link type="text/css" href="style/connexion.css" rel="stylesheet" media="all">
    <link type="text/css" href="style/inscription.css" rel="stylesheet" media="all">

    <title>To Do List</title>
</head>


<body class="bg-white">
<header>
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand pl-5" href="../index.php"><img src="img/logo.png"
                                                           class="rounded float-left"
                                                           alt="logo To DO List"></a>
        <div class="collapse navbar-collapse justify-content-end mr-5" id="navbarNav">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <?php
                global $rep;
                require(__DIR__ . '/../model/ModelUtilisateur.php');
                if (ModelUtilisateur::isUtilisateur()){?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=AfficherListeTachesPrivees">Mes Listes privées</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=Deconnexion">Se Déconnecter</a>
                </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=action=AfficherConnexion">Se Connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=action=AfficherInscription">S'inscrire</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <hr>
</header>

<div class="jumbotron jumbotron-fluid" id="banniere">
    <div class="container-fluid bg-info">
        <h1 class="display-4 font-weight-bold">To Do List - Baptiste Martel G1</h1>
    </div>
</div>
