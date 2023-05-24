<?php
ob_start();
?>
<div class="p-5 m-5">
    <form method="POST" action="<?= URL ?>connexion/3" class="d-grid gap-2 col-12 col-md-8 mx-auto rounded shadow p-5 m-5">
        <div class="form-group mb-3 px-5 mx-5">
            <label for="pseudo" class="form-label text-muted fs-5 mb-2">Pseudo :</label>
            <input type="text" class="form-control rounded-pill py-3 px-4 border-0 shadow-sm" id="pseudo" name="Pseudo" placeholder="Entrez votre pseudo">
        </div>
        <div class="form-group mb-4 px-5 mx-5">
            <label for="password" class="form-label text-muted fs-5 mb-2">Mot de passe :</label>
            <input type="password" class="form-control rounded-pill py-3 px-4 border-0 shadow-sm" id="password" name="Password" placeholder="Entrez votre mot de passe">
        </div>
        <div class="d-grid gap-2 m-3 px-5 mx-5">
            <button type="submit" name="Connecter" class="btn btn-primary rounded-pill py-3 fs-5 fw-bold">Se connecter</button>
        </div>
        <div class="text-center px-5 mx-5 pb-5">
            <p class="text-dark ">Devenir membre ? <a href="inscription">S'enregistrer</a></p>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
require "template.php";
?>