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

    <h1>S'inscrire</h1>
    <form method='post' action="index.php?action=Inscription">
        <p>
            <label for="inputPseudo">Nom d'utilisateur</label>
            <input type="text" id="inputPseudo" placeholder="Entrez le nom d'utilisateur..." name="pseudo" required>
        </p>

        <p>
            <label for="inputMdp">Mot de passe </label>
            <input type="password" id="inputMdp" placeholder="Entrez le mot de passe..." name="mdp" required>
        </p>

        <p>
            <label for="inputMdp">Retapez le mot de passe </label>
            <input type="password" id="inputReMdp" placeholder="Entrez le mot de passe..." name="remdp" required>
        </p>

        <p>
            <input type="submit" value='SIGNIN'>
        </p>

    </form>

</div>


</body>
