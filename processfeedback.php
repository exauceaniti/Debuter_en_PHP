<?php
if (isset($_POST['nom'], $_POST['email'], $_POST['commentaire']) &&
    !empty($_POST['nom']) &&
    !empty($_POST['email']) &&
    !empty($_POST['commentaire'])) {

    // Création de noms abrégés pour les variables
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $commentaire = $_POST['commentaire'];

    // Initialisation de quelques informations
    $adresse_dest = "exauceaniti@gmail.com";
    $sujet = "Message provenant du site web";
    $contenu_message = 
        "Nom client : " . $nom . "\n" .
        "Email client : " . $email . "\n" .
        "Commentaire :\n" . $commentaire . "\n";
    $adresse_exp = "From:Ghislainmkgh@gmail.com"; // Attention : pas d'espace après "From:"

    mail($adresse_dest, $sujet, $contenu_message, $adresse_exp);

    // Message HTML de confirmation
    echo "<html>
            <head><title>Le garage de Exau -- Commentaire transmis</title></head>
            <body>
            <h1>Commentaire transmis</h1>
            <p>Votre commentaire a été envoyé.</p>
            </body>
          </html>";
} else {
    // Message d'erreur si un champ est vide
    echo "<html>
            <head><title color:red>Erreur d'envoie </title></head>
            <body>
            <h1>Erreur</h1>
            <p>Veuillez remplir tous les champs du formulaire.</p>
            </body>
          </html>";
}
?>
