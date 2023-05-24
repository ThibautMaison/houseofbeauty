<?php
ob_start();
$erreur = "";
?>


<form method="POST" action="" class="d-grid gap-2 col-12 col-md-8 mx-auto mt-5 rounded shadow p-5">
    <div class="form-group mb-3 mt-5 pt-5 px-5 mx-5">
        <label for="pseudo" class="form-label text-muted fs-5 mb-2">Pseudo :</label>
        <input type="text" class="form-control rounded-pill py-3 px-4 border-0 shadow-sm" id="pseudo" name="Pseudo" placeholder="Entrez votre pseudo">
        <div id="confirmepseudo"></div>
    </div>
    <div class="form-group mb-3 px-5 mx-5">
        <label for="email" class="form-label text-muted fs-5 mb-2">Email :</label>
        <input type="text" class="form-control rounded-pill py-3 px-4 border-0 shadow-sm" id="email" name="Email" placeholder="Entrez votre email">
        <div id="confirmeemail"></div>
    </div>
    <div class="form-group mb-4 px-5 mx-5">
        <label for="password" class="form-label text-muted fs-5 mb-2">Mot de passe :</label>
        <input type="password" class="form-control rounded-pill py-3 px-4 border-0 shadow-sm" id="password" name="Password" placeholder="Entrez votre mot de passe">
        <div id="confirmepassword"></div>
    </div>
    
    <div class="form-group mb-4 px-5 mx-5">
        <label for="confirmpassword" class="form-label text-muted fs-5 mb-2">Confirmez votre mot de passe :</label>
        <input type="password" class="form-control rounded-pill py-3 px-4 border-0 shadow-sm" id="confirmpassword" name="ConfirmPassword" placeholder="Confirmez votre mot de passe">
        <div id="confirmepasswordconfirmation"></div>
    </div>

    <div class="d-grid gap-2 mt-3 px-5 mx-5">
        <button type="submit" name="Sinscrire" class="btn btn-primary rounded-pill py-3 fs-5 fw-bold">S'inscrire</button>
    </div>
    <?php
if (isset($_POST['Sinscrire'])) {
    $pseudo = $_POST['Pseudo'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $confirmpassword = $_POST['ConfirmPassword'];

    $erreur = '';

    if (empty($pseudo)) {
        $erreur .= "Le champ Pseudo est requis.<br>";
    } elseif (preg_match('/\s/', $pseudo)) {
        $erreur .= "Le pseudo ne doit pas contenir d'espaces.<br>";
    } elseif (ctype_digit($pseudo)) {
        $erreur .= "Le pseudo ne doit pas contenir que des chiffres.<br>";
    } elseif (!preg_match('/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/', $pseudo)) {
        $erreur .= "Le pseudo doit commencer par une lettre et ne doit contenir que des lettres, des chiffres et des underscores.<br>";
    }

    if (empty($email)) {
        $erreur .= "Le champ Email est requis.<br>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur .= "L'email saisi n'est pas valide.<br>";
    }

    if (empty($password)) {
        $erreur .= "Le champ Mot de passe est requis.<br>";
    }
if (empty($confirmpassword)) {
    $erreur .= "Le champ Confirmez votre mot de passe est requis.<br>";
} elseif ($password != $confirmpassword) {
    $erreur .= "Les mots de passe saisis ne correspondent pas.<br>";
}

if (empty($erreur)) {
    $_SESSION['Pseudo'] = $pseudo;
    $_SESSION['Email'] = $email;
    $_SESSION['Password'] = $password;
    $_SESSION['Role'] = 0;
    header("Location: " . URL . "inscription/9");
}
}
?>
</form>
<?php if (!empty($erreur)): ?>
    <div class="alert alert-danger px-5 mx-5">
        <?= $erreur ?>
    </div>
<?php endif; ?>
<script>
const pseudo = document.querySelector('#pseudo');
const pseudoConfirmation = document.querySelector('#confirmepseudo');
const email = document.querySelector('#email');
const emailConfirmation = document.querySelector('#confirmeemail');
const password = document.querySelector('#password');
const passwordConfirmation = document.querySelector('#confirmepassword');
const confirmPassword = document.querySelector('#confirmpassword');
const confirmPasswordConfirmation = document.querySelector('#confirmepasswordconfirmation');

let pseudoIsNotEmpty = false;
let pseudoHasValidFormat = false;
let pseudoHasValidLength = false;
let passwordIsNotEmpty = false;
let passwordHasValidLength = false;
let passwordHasUpperCase = false;
let passwordHasLowerCase = false;
let passwordHasNumber = false;
let passwordHasSpecialCharacter = false;
let confirmPasswordIsNotEmpty = false;
let passwordsMatch = false;

pseudo.addEventListener('input', function() {
  const value = pseudo.value.trim();

  // Vérifier si le pseudo n'est pas vide
  if (value !== '') {
    pseudoIsNotEmpty = true;
  } else {
    pseudoIsNotEmpty = false;
    pseudoConfirmation.innerHTML = 'Le pseudo ne peut pas être vide.';
    pseudoConfirmation.classList.add('text-danger');
    pseudo.classList.add('is-invalid');
    return;
  }

  // Vérifier si le pseudo a un format valide
  if (/^[a-zA-Z][\w]*$/.test(value)) {
    pseudoHasValidFormat = true;
  } else {
    pseudoHasValidFormat = false;
    pseudoConfirmation.innerHTML = 'Le pseudo doit commencer par une lettre et ne doit contenir que des lettres, des chiffres et des underscores.';
    pseudoConfirmation.classList.add('text-danger');
    pseudo.classList.add('is-invalid');
    return;
  }

  // Vérifier si le pseudo a une longueur valide
  if (value.length >= 5) {
    pseudoHasValidLength = true;
  } else {
    pseudoHasValidLength = false;
    pseudoConfirmation.innerHTML = 'Le pseudo doit contenir au moins 5 caractères.';
    pseudoConfirmation.classList.add('text-danger');
    pseudo.classList.add('is-invalid');
    return;
  }

  // Si toutes les validations sont réussies, afficher un message de confirmation et marquer le champ comme valide
  if (pseudoIsNotEmpty && pseudoHasValidFormat && pseudoHasValidLength) {
    pseudoConfirmation.innerHTML = 'Pseudo valide.';
    pseudoConfirmation.classList.remove('text-danger');
    pseudoConfirmation.classList.add('text-success');
    pseudo.classList.remove('is-invalid');
    pseudo.classList.add('is-valid');
  }
});

email.addEventListener('input', function() {
  const value = email.value.trim();
  
  // Vérifiez si le champ est vide ou si l'e-mail n'est pas valide
  if (value === '' || !/\S+@\S+\.\S+/.test(value)) {
    emailConfirmation.innerHTML = 'Entrez une adresse e-mail valide.';
    emailConfirmation.classList.add('text-danger');
    email.classList.add('is-invalid');
  } else {
    emailConfirmation.innerHTML = 'E-mail valide.';
    emailConfirmation.classList.remove('text-danger');
    emailConfirmation.classList.add('text-success');
    email.classList.remove('is-invalid');
    email.classList.add('is-valid');
  }
});

password.addEventListener('input', function() {
  const value = password.value.trim();

  // Vérifier si le mot de passe n'est pas vide
  if (value !== '') {
    passwordIsNotEmpty = true;
  } else {
    passwordIsNotEmpty = false;
    passwordConfirmation.innerHTML = 'Le mot de passe ne peut pas être vide.';
    passwordConfirmation.classList.add('text-danger');
    password.classList.add('is-invalid');
    return;
  }

  // Vérifier si le mot de passe a une longueur valide
  if (value.length >= 8) {
    passwordHasValidLength = true;
  } else {
    passwordHasValidLength = false;
    passwordConfirmation.innerHTML = 'Le mot de passe doit contenir au moins 8 caractères.';
    passwordConfirmation.classList.add('text-danger');
    password.classList.add('is-invalid');
    return;
  }

  // Vérifier si le mot de passe contient au moins une lettre majuscule
  if (/[A-Z]/.test(value)) {
    passwordHasUpperCase = true;
  } else {
    passwordHasUpperCase = false;
    passwordConfirmation.innerHTML = 'Le mot de passe doit contenir au moins une lettre majuscule.';
    passwordConfirmation.classList.add('text-danger');
    password.classList.add('is-invalid');
    return;
  }

  // Vérifier si le mot de passe contient au moins une lettre minuscule
  if (/[a-z]/.test(value)) {
    passwordHasLowerCase = true;
  } else {
    passwordHasLowerCase = false;
    passwordConfirmation.innerHTML = 'Le mot de passe doit contenir au moins une lettre minuscule.';
    passwordConfirmation.classList.add('text-danger');
    password.classList.add('is-invalid');
    return;
  }

  // Vérifier si le mot de passe contient au moins un chiffre
  if (/\d/.test(value)) {
    passwordHasNumber = true;
  } else {
    passwordHasNumber = false;
    passwordConfirmation.innerHTML = 'Le mot de passe doit contenir au moins un chiffre.';
    passwordConfirmation.classList.add('text-danger');
    password.classList.add('is-invalid');
    return;
  }

  // Vérifier si le mot de passe contient au moins un caractère spécial
  if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) {
    passwordHasSpecialCharacter = true;
  } else {
    passwordHasSpecialCharacter = false;
    passwordConfirmation.innerHTML = 'Le mot de passe doit contenir au moins un caractère spécial.';
    passwordConfirmation.classList.add('text-danger');
    password.classList.add('is-invalid');
    return;
  }

  // Si toutes les validations sont réussies, afficher un message de confirmation et marquer le champ comme valide
  if (passwordIsNotEmpty && passwordHasValidLength && passwordHasUpperCase && passwordHasLowerCase && passwordHasNumber && passwordHasSpecialCharacter) {
    passwordConfirmation.innerHTML = 'Mot de passe valide.';
    passwordConfirmation.classList.remove('text-danger');
    passwordConfirmation.classList.add('text-success');
    password.classList.remove('is-invalid');
    password.classList.add('is-valid');
  }
});

confirmPassword.addEventListener('input', function() {
  const passwordValue = password.value.trim();
  const confirmPasswordValue = confirmPassword.value.trim();

  // Vérifier si le champ de confirmation de mot de passe n'est pas vide
  if (confirmPasswordValue !== '') {
    confirmPasswordIsNotEmpty = true;
  } else {
    confirmPasswordIsNotEmpty = false;
    confirmPasswordConfirmation.innerHTML = 'Le champ de confirmation de mot de passe ne peut pas être vide.';
    confirmPasswordConfirmation.classList.add('text-danger');
    confirmPassword.classList.add('is-invalid');
    return;
  }

  // Vérifier si les mots de passe saisis correspondent
  if (confirmPasswordValue === passwordValue) {
    passwordsMatch = true;
  } else {
    passwordsMatch = false;
    confirmPasswordConfirmation.innerHTML = 'Les mots de passe saisis ne correspondent pas.';
    confirmPasswordConfirmation.classList.add('text-danger');
    confirmPassword.classList.add('is-invalid');
    return;
  }

  // Si toutes les validations sont réussies, afficher un message de confirmation et marquer le champ comme valide
  if (confirmPasswordIsNotEmpty && passwordsMatch) {
    confirmPasswordConfirmation.innerHTML = 'Confirmation de mot de passe valide.';
    confirmPasswordConfirmation.classList.remove('text-danger');
    confirmPasswordConfirmation.classList.add('text-success');
    confirmPassword.classList.remove('is-invalid');
    confirmPassword.classList.add('is-valid');
  }
});
</script>

<?php
$content = ob_get_clean();
require "template.php";
?>