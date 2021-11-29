<?php require("vueHeader.php") ?>

<div class="container AjoutEntite">
    <h2>Ajout d'une liste publique</h2>
    <form method='post' action="index.php?action=AjouterTitreListePublique">
        <input class="InputSaisie" type="text" name="nomListe" placeholder="Nom de la liste..." value="" required>
        <input type="submit" class="AddBtn InputSaisie" value="Ajouter la liste">
    </form>
</div>

<div class="row align-items-start">

    <?php
    require_once(__DIR__ . "/../config/config.php");
    require_once(__DIR__ . "/../config/Autoload.php");
    Autoload::charger();
    
    global $rep,$dsn,$login,$mdp;

    $gt = new ListeTachesGateway(new Connexion($dsn,$login,$mdp));
    $tachegateway = new TacheGateway(new Connexion($dsn, $login, $mdp));
    $tabListeTaches = $gt->getAllListeTachesPublic();
    foreach ($tabListeTaches as $listetaches) {
        $listetaches->setListeTaches($tachegateway->getAllTachesByIdListeTaches($listetaches->getIdListeTaches()));
    }
    foreach ($tabListeTaches as $liste) {
        ?>
        <div class="col-12 col-md-6 col-lg-6 text-center text-dark">
            <figcaption class="Listes">
                <h2><?php echo $liste->getNom();
                    $i = 0; ?></h2>
                <ul>
                    <?php
                    $tab = $liste->getListeTaches();
                    foreach ($tab as $tache) {
                        if (!$tache->getTerminee() && $i <= $tacheMax) { ?>
                            <li><?php echo $tache->getNom();
                                $i++ ?></li>
                        <?php } else { ?>
                            <li>
                                <del><?php echo $tache->getNom();
                                    $i++ ?></del>
                            </li>
                        <?php }
                    } ?>
                    <li>etc ...</li>
                </ul>
                <form method='post' action="index.php?action=AfficherDetailListe">
                    <input type="hidden" name="idListeTaches" value="<?php echo $liste->getIdListeTaches(); ?>">
                    <button type="submit" class="btn btn-outline-primary">Cliquez pour voir plus de tâches</button>
                </form>
            </figcaption>
        </div>
    <?php } ?>
</div>

<script src="scripts/jquery-3.3.1.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/scroll-animate.js"></script>

</body>
</html>