<?php
// Démarrage de la temporisation de sortie
ob_start();
?>
<?php
// Initialisation de la variable index à 0
$index = 0;
?>
<!-- Création de la section principale avec des classes de mise en page et un margin-top -->
<section class="main-section d-flex align-items-center justify-content-center" style="margin-top: 150px;">
  <div class="container">
    <?php foreach ($components as $component) : ?>
      <?php $index = 0; ?>
      <div class="col m-0 mb-5">
        <h3 class="text-center"><?= $component->getTitre() ?></h3>
        <?php if (isset($_SESSION['Pseudo']) && $_SESSION['Role'] == 1) : ?>
          <div class="text-center pb-3">
            <a href="<?= URL ?>component/supp/<?= $component->getIdComponent() ?>" class="btn btn-danger">Supprimer le titre</a>
          </div>
        <?php endif; ?>
        <div class="row align-items-center"> <!-- Ajout de la classe align-items-center -->
          <?php if ($component->getIdComponent() % 2 != 0) : ?>
            <div class="col-lg-6"> <!-- Ajout de la classe col-lg-6 -->
              <?php foreach ($descriptions as $description) : ?>
                <?php if ($component->getIdComponent() == $description->getIdComponent()) : ?>
                  <p class="text-center w-100"><?= $description->getPrix() ?></p> <!-- Suppression de la classe d-flex et justify-content-center -->
                  <?php if (isset($_SESSION['Pseudo']) && $_SESSION['Role'] == 1) : ?>
                    <div class="text-center pb-3">
                      <a href="<?= URL ?>description/supp/<?= $description->getIdDescription() ?>" class="btn btn-danger">Supprimer la description</a>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endforeach; ?>
              <?php if (isset($_SESSION['Pseudo']) && $_SESSION['Role'] == 1) : ?>
                <form action="<?= URL ?>description/l" method="POST">
                  <input type="hidden" name="idComponent" value="<?= $component->getIdComponent() ?>">
                  <div class="mb-3">
                    <textarea class="form-control" name="description" rows="5" required></textarea>
                  </div>
                  <div class="text-center">
                    <input class="btn btn-success" type="submit" value="Ajouter une description">
                  </div>
                </form>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <div class="col-lg-6"> <!-- Ajout de la classe col-lg-6 -->
            <div id="carousel-<?= $component->getIdComponent() ?>" class="carousel slide d-flex align-items-center justify-content-center" data-bs-ride="carousel">
              <div class="carousel-inner">
                <?php foreach ($images as $image) : ?>
                  <?php if ($image->getIdComponent() == $component->getIdComponent()) : ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                      <img src="/public/images/<?= $image->getNomImage() ?>" class="d-block mx-auto img-fluid rounded mt-5 shadow-lg" style="max-width: 400px; height: auto;" alt=""> <!-- Utilisation de max-width et ajout de mx-auto -->
                      <?php if (isset($_SESSION['Pseudo']) && $_SESSION['Role'] == 1) : ?>
                        <div class="text-center py-3">
                          <a href="<?= URL ?>image/supp/<?= $image->getIdImage() ?>" class="btn btn-danger">Supprimer l'image</a>
                        </div>
                      <?php endif; ?>
                    </div>
                    <?php $index++; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?= $component->getIdComponent() ?>" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?= $component->getIdComponent() ?>" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
              </button>
            </div>

          </div>
          <?php if ($component->getIdComponent() % 2 == 0) : ?>
            <div class="col-lg-6"> <!-- Ajout de la classe col-lg-6 -->
              <?php foreach ($descriptions as $description) : ?>
                <?php if ($component->getIdComponent() == $description->getIdComponent()) : ?>
                  <div class="description-block">
                    <p class="text-center"><?= $description->getPrix() ?></p>
                    <?php if (isset($_SESSION['Pseudo']) && $_SESSION['Role'] == 1) : ?>
                      <div class="text-center pb-3">
                        <a href="<?= URL ?>description/supp/<?= $description->getIdDescription() ?>" class="btn btn-danger text-center">Supprimer la description</a>
                      </div>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
              <?php if (isset($_SESSION['Pseudo']) && $_SESSION['Role'] == 1) : ?>
                <form action="<?= URL ?>description/l" method="POST" class="description-form">
                  <input type="hidden" name="idComponent" value="<?= $component->getIdComponent() ?>">
                  <div class="mb-3">
                    <textarea class="form-control" name="description" rows="5" placeholder="Ajouter une description" required></textarea>
                  </div>
                  <div class="text-center">
                    <button class="btn btn-success" type="submit">Ajouter une description</button>
                  </div>
                </form>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Création d'un bloc pour ajouter un titre -->
<div class="d-flex align-items-center justify-content-center mt-5">
  <?php // Vérification si l'utilisateur est connecté et a le rôle 1 (administrateur)
  if (isset($_SESSION['Pseudo'])) {
    if ($_SESSION['Role'] == 1) { ?>
      <!-- Création du formulaire pour ajouter un titre -->
      <form action="<?= URL ?>component/l" method="POST" class="col-lg-6">
        <div class="mb-3">
          <!-- Champ de saisie pour le titre -->
          <textarea class="form-control" name="titre" rows="5" required></textarea>
        </div>
        <!-- Bouton pour soumettre le formulaire -->
        <div class="text-center">
          <input class="btn btn-success" type="submit" value="Ajouter un titre">
        </div>
      </form>
  <?php }
  } ?>
</div>
</div>

<?php
// Capture du contenu du tampon de sortie et stockage dans la variable $content
$content = ob_get_clean();
// Inclusion du fichier de template
require "template.php";
?>