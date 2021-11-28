<?php require("vueHeader.php") ?>

<div id="containerDescription">

    <label>Description de la liste de tâches</label>

    <?php if ($privee == true){ ?>
    <form method='post' action="index.php?action=AjouterListePrivee">
        <textarea class="form-control" name="description" placeholder="Saisissez la description de la liste de tâche"
                  style="height: 30%"></textarea>
        <input type="hidden" name="nomListe" value="<?php echo $nomListe ?>">
        <button type="submit" class="btn btn-outline-primary">Ajouter la liste</button>
    </form>
    <?php }
    else { ?>
         <form method='post' action="index.php?action=AjouterListePublique">
        <textarea class="form-control" name="description" placeholder="Saisissez la description de la liste de tâche"
                  style="height: 30%"></textarea>
        <input type="hidden" name="nomListe" value="<?php echo $nomListe ?>">
        <button type="submit" class="btn btn-outline-primary">Ajouter la liste</button>
    </form>
    <?php } ?>
</div>
</body>
