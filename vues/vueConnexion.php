<?php require("vueHeader.php") ?>
<?php
if (isset($data) && !empty($data)) { ?>
    <div class="alert alert-warning div-alert-inscription-perso" role="alert" style="text-align: center">
        <?php foreach ($data as $d) {
            echo $d;
        } ?>
    </div>
    <?php
}
?>
<div id="containerConnexion">

    <h1>Connectez-vous</h1>
    <form method='post' action="index.php?action=Connexion">
        <p>
            <label for="inputPseudo">Nom d'utilisateur</label>
            <input type="text" id="inputPseudo" placeholder="Entrez le nom d'utilisateur..." name="pseudo" required>
        </p>

        <p>
            <label for="inputMdp">Mot de passe </label>
            <input type="password" id="inputMdp" placeholder="Entrez le mot de passe..." name="mdp" required>
        </p>

        <p>
            <input type="submit" value='LOGIN'>
        </p>

    </form>

</div>


</body>

