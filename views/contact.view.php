<?php
ob_start();
?>

<form method="POST" class="d-grid gap-2 col-6 mx-auto mt-5 p-5">
    <div class="alert-container"></div>
    <div class="form-group mb-2 rounded pt-5">
        <label class="form-label text-dark" for="pseudo">Pseudo :</label>
        <input type="text" class="form-control rounded" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo">
        <span id="pseudo-error" class="error"></span>
    </div>
    <div class="form-group mb-2 rounded">
        <label class="form-label text-dark" for="email">Email :</label>
        <input type="email" class="form-control rounded" id="email" name="email" placeholder="Entrez votre email">
        <span id="email-error" class="error"></span>
    </div>
    <div class="form-group mb-2 rounded">
        <label class="form-label text-dark" for="sujet">Sujet :</label>
        <input type="text" class="form-control rounded" id="sujet" name="sujet" placeholder="Entrez le sujet de votre message">
        <span id="sujet-error" class="error"></span>
    </div>
    <div class="form-group mb-2 rounded">
        <label class="form-label text-dark" for="message">Message :</label>
        <textarea class="form-control rounded" id="message" name="message" placeholder="Entrez votre message" rows="6"></textarea>
        <span id="message-error" class="error"></span>
    </div>
    <div class="form-check d-flex justify-content-center m-4">
        <input class="form-check-input me-2 mt-3" type="checkbox" name="copy" value="" checked>
        <label class="form-check-label text-dark mt-3" for="copy">Envoyer une copie de ce message</label>
    </div>
    <button type="submit" name="Envoyer" class="btn btn-outline-light rounded-pill mb-5 d-grid gap-2 col-6 mx-auto rounded" onclick="return validateForm()">Envoyer</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier que les champs requis ont été soumis
    if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['sujet']) && !empty($_POST['message'])) {
        $destinataire = "thibauttayzer@gmail.com";
        $sujet = $_POST['sujet'];
        $message = $_POST['message'];
        $expediteur = $_POST['email'];
        $headers = "From: $expediteur\r\n";
        
        // Vérifier si la case à cocher a été cochée
        if (isset($_POST['copy'])) {
            // Envoyer une copie du message à l'expéditeur
            $retour = mail($expediteur, $sujet, $message, $headers);
        }
        
        // Ajouter le nom de l'expéditeur dans le message
        $message .= "\n\nCe message vous a été envoyé via la page contact du site taiizer.fr\nNom : " . $_POST["pseudo"] . "\nEmail : " . $_POST["email"];
        
        // Envoyer le message
        $retour = mail($destinataire, $sujet, $message, $headers);
        
        // Vérifier si le message a été envoyé avec succès
        if ($retour) {
            echo '<div class="alert alert-success" role="alert">Votre message a été envoyé avec succès.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Une erreur est survenue lors de l\'envoi du message.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Tous les champs sont requis.</div>';
    }
}
?>
<script>
var pseudoInput = document.getElementById("pseudo");
var emailInput = document.getElementById("email");
var sujetInput = document.getElementById("sujet");
var messageInput = document.getElementById("message");

pseudoInput.addEventListener("input", function() {
    var pseudo = pseudoInput.value;
    if (pseudo == "") {
        document.getElementById("pseudo-error").innerHTML = "Veuillez entrer votre pseudo";
    } else {
        document.getElementById("pseudo-error").innerHTML = "";
    }
});

emailInput.addEventListener("input", function() {
    var email = emailInput.value;
    if (email == "") {
        document.getElementById("email-error").innerHTML = "Veuillez entrer votre email";
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById("email-error").innerHTML = "Veuillez entrer un email valide";
    } else {
        document.getElementById("email-error").innerHTML = "";
    }
});

sujetInput.addEventListener("input", function() {
    var sujet = sujetInput.value;
    if (sujet == "") {
        document.getElementById("sujet-error").innerHTML = "Veuillez entrer le sujet de votre message";
    } else {
        document.getElementById("sujet-error").innerHTML = "";
    }
});

messageInput.addEventListener("input", function() {
    var message = messageInput.value;
    if (message == "") {
        document.getElementById("message-error").innerHTML = "Veuillez entrer votre message";
    } else {
        document.getElementById("message-error").innerHTML = "";
    }
});

function validateForm() {
    var pseudo = pseudoInput.value;
    var email = emailInput.value;
    var sujet = sujetInput.value;
    var message = messageInput.value;
    var error = false;

    // Vérifiez que le champ pseudo n'est pas vide
    if (pseudo == "") {
        document.getElementById("pseudo-error").innerHTML = "Veuillez entrer votre pseudo";
        error = true;
    } else {
        document.getElementById("pseudo-error").innerHTML = "";
    }

    // Vérifiez que le champ email est un email valide
    if (email == "") {
        document.getElementById("email-error").innerHTML = "Veuillez entrer votre email";
        error = true;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById("email-error").innerHTML = "Veuillez entrer un email valide";
        error = true;
    } else {
        document.getElementById("email-error").innerHTML = "";
    }

    // Vérifiez que le champ sujet n'est pas vide
    if (sujet == "") {
        document.getElementById("sujet-error").innerHTML = "Veuillez entrer le sujet de votre message";
        error = true;
    } else {
        document.getElementById("sujet-error").innerHTML = "";
    }

    // Vérifiez que le champ message n'est pas vide
    if (message == "") {
        document.getElementById("message-error").innerHTML = "Veuillez entrer votre message";
        error = true;
    } else {
        document.getElementById("message-error").innerHTML = "";
    }

    return !error;
}
</script>
<?php
$content=ob_get_clean();
require "template.php";
?>