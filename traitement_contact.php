<?php
// Variables pour messages
$errors = [];
$success = false;

// Traiter le formulaire uniquement si méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et nettoyer les données
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $commentaire = trim($_POST['commentaire'] ?? '');

    // Validation
    if ($nom === '') {
        $errors[] = "Le nom est obligatoire.";
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email est invalide.";
    }
    if ($commentaire === '') {
        $errors[] = "Le message ne peut pas être vide.";
    }

    if (empty($errors)) {
        // Préparer email
        $email_destinateur = "exauceaniti@gmail.com"; 
        $subject = "Nouveau message de contact - Maseka Food";
        $headers = "From: $nom <$email>\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8\r\n";

        $body = "Nom : $nom\nEmail : $email\n\nMessage :\n$commentaire\n\nDate : " . date('d/m/Y H:i:s');

        // Envoi mail
        $mailSent = mail($email_destinateur, $subject, $body, $headers);

        // Sauvegarde dans feedback.txt
        $fileFeedback = __DIR__ . '/orders/feedback.txt';
        $log = "------------------------\n";
        $log .= "Date: " . date('d/m/Y H:i:s') . "\n";
        $log .= "Nom: $nom\nEmail: $email\nMessage:\n$commentaire\n\n";

       file_put_contents($fileFeedback, $log, FILE_APPEND | LOCK_EX);

       if (file_put_contents($fileFeedback, $log, FILE_APPEND | LOCK_EX) === false) {
      // Gérer erreur d'écriture ici
      $errors[] = "Impossible de sauvegarder le message.";
}


        if ($mailSent) {
            $success = true;
        } else {
            $errors[] = "Erreur lors de l'envoi de l'email. Veuillez réessayer plus tard.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Contact - Résultat</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #fff0f0; }
        .success { color: green; font-weight: bold; }
        .error { color: red; }
        a { display: inline-block; margin-top: 20px; color: #f79f9f; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<?php if ($success): ?>
    <p class="success">Merci pour votre message, nous vous répondrons rapidement !</p>
    <a href="contact.php">Retour au formulaire</a>
<?php else: ?>
    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?php echo htmlspecialchars($err); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <a href="javascript:history.back()">Retour au formulaire</a>
<?php endif; ?>

</body>
</html>
