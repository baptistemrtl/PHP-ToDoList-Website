<?php require("vueHeader.php") ?>


<div id="VoirPlusTache" class="container">

    <h2><?php echo $listetaches->getNom() ?></h2>

    <table>
        <tr>
            <?php foreach ($listetaches->getListeTaches() as $tache) {
            if (!$tache->getTerminee()) { ?>
                <div>
                    <td><?php echo $tache->getNom() ?></td>
                </div>

                <td>
                    <form method="post" action="index.php?action=UpdateTerminee">
                        <div class="d-inline-flex">
                            <input type="hidden" name="idTache" value="<?php echo $tache->getIdTache() ?>">
                            <input type="checkbox" class="mt-3 ml-3 align-self-center" name="UpdateTerminee" value="1">
                            <input type="submit" class="addBtn mt-3 ml-3" id="updateTerminee" value="Valider">
                        </div>
                    </form>

                </td>

                <td>
                    <form method="post" action="index.php?action=SupprimerTache">
                        <input type="hidden" name="idTache" value="<?php echo $tache->getIdTache() ?>">
                        <button class="btn btn-outline-primary inputSupprimerTache" type="submit"> Supprimer Tache</button>
                    </form>
                </td>


            <?php }
            if ($tache->getTerminee()) { ?>
                <div>
                    <td>
                        <del><?php echo $tache->getNom() ?></del>
                    </td>
                </div>

                <td>
                    <form method="post" action="index.php?action=UpdateTerminee">
                        <div class="d-inline-flex">
                        <input type="hidden" name="idTache" value="<?php echo $tache->getIdTache() ?>">
                        <input type="checkbox" class="mt-3 ml-3 align-self-center" name="UpdateTerminee" value="0" checked>
                        <input type="submit" class="addBtn  mt-3 ml-3" id="updateTerminee" value="Valider">
                        </div>
                    </form>
                </td>

                <td>
                    <form method="post" action="index.php?action=SupprimerTache">
                        <input type="hidden" name="idTache" value="<?php echo $tache->getIdTache() ?>">
                        <button class="btn btn-outline-primary inputSupprimerTache" type="submit"> Supprimer Tache</button>
                    </form>
                </td>


            <?php } ?>
        </tr>
        <?php } ?>

    </table>

    <h4>Description de la liste de tâches : </h4>
    <article><?php echo $listetaches->getDescription() ?></article>
</div>

<div class="container AjoutEntite">
    <h2>Ajouter une tâche</h2>
    <form method="post" action="index.php?action=AjouterTache">
        <input type="hidden" name="idListeTaches" value="<?php echo $listetaches->getIdListeTaches() ?>">
        <input class="InputSaisie" name="NomTache" type="text" placeholder="Entrez le nom de la tâche" required>
        <input type="submit" class="AddBtn mb-5 InputSaisie" value="Ajouter la tâche">
    </form>
</div>

<div class="container">


    <form method="post" action="index.php?action=SupprimerListeTaches" >
        <input type="hidden" name="idListeTaches" value="<?php echo $listetaches->getIdListeTaches() ?>">
        <button class="btn btn-outline-primary" id="inputSupprimerListe" type="submit"> Supprimer Liste Taches</button>
    </form>

</div>
</body>