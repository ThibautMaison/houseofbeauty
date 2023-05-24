<?php
ob_start();
?>
<div class="container pt-5">
    <div class="pt-5 row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-center">Commentaires</h1>

            <h2 class="mb-4 text-center">Liste des commentaires :</h2>
            <?php if (isset($_SESSION['Pseudo'])) : ?>
                <form action="<?= URL ?>avis/l" method="POST">
                    <div class="mb-3">
                        <textarea class="form-control" name="commentaire" rows="5" required></textarea>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" value="Ajouter un commentaire">
                    </div>
                </form>
            <?php else : ?>
                <p class="text-center">Connectez-vous pour ajouter un commentaire.</p>
            <?php endif; ?>
            <?php
            if ($aa != 0) {
                foreach ($aa as $a) {
                   echo "<div>";
                    echo "<p><strong>" . $a->getPseudo() . "</strong></p>";
                    echo "<p>" . $a->getCommentaire() . "</p>";

                    $date = new DateTime($a->getDateCommentaire());
                    $date->setTimezone(new DateTimeZone('Europe/Paris'));
                    echo "<p><small>" . $date->format('l d F Y H:i:s') . "</small></p>";

                    echo "</div>";
                    if (isset($_SESSION['idUsers']) && $_SESSION['idUsers'] == $a->getIdUsers()) {
            ?>
                        <button><a href="<?= URL ?>avis/supp/<?= $a->getIdCommentaire() ?>">supprimer</a></button><br>
            <?php

                    }
                }
            } else {
                echo "rien";
            }
            ?>

            
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require "template.php";
?>