<?php
ob_start();
?>
<section class="main-section d-flex align-items-center justify-content-center pt-4" style="height: 70vh; background: url('/public/images/formation-cap-esthetique.jpg') no-repeat center center/cover; margin-top: 80px;">
  <div class="container text-center" style="z-index: 1;">
    <h1 class="display-4 text-white text-uppercase" style="text-shadow: 0 0 10px #000, 0 0 20px #000;">House of beauty</h1>
    <p class="lead text-white" style="text-shadow: 0 0 10px #000, 0 0 20px #000;">Nous offrons une gamme complète de soins de beauté pour vous aider à vous sentir bien dans votre peau. Venez nous voir pour une expérience de détente et de beauté.</p>
  </div>
</section>
<section class="second-section d-flex align-items-end pt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex align-items-center justify-content-center">
        <div class="text-center">
          <h2 class="text-dark">Titre de la section</h2>
          <p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin nulla ac massa sagittis interdum. Vivamus ullamcorper ex lectus, vel ullamcorper justo tincidunt non. Sed auctor, elit vitae pulvinar vestibulum, velit arcu malesuada orci, vitae faucibus elit elit in elit. In vitae elit ullamcorper, finibus ante eu, tincidunt mi. Donec volutpat orci vitae magna varius posuere.</p>
        </div>
      </div>
      <div class="col-lg-6 mt-5 mt-lg-0">
        <div class="card text-center shadow-lg" style="background-color: rgba(255, 255, 255, 0.7); border: none; border-radius: 50px;">
          <div class="card-body p-5">
            <h2 class="card-title pt-2">HORAIRES</h2>
            <p class="card-text" style="line-height: 2rem;">
              Du Lundi au Vendredi :<br>
              9h00 - 12h00 / 14h00 - 19h00<br>
              <br>
              Le Samedi :<br>
              9h00 - 12h00 / 14h00 - 18h00<br>
              (ouvert entre 12h et 14h sur rendez-vous)<br>
              <br>
              <a href="tel:0646534393" class="btn btn-primary mb-2 py-3 px-4 rounded-pill shadow">Appelez-nous</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<?php
$content = ob_get_clean();
require "template.php";
?>