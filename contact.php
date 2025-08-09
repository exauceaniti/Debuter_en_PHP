<?php require 'header.php'; ?>
 <html>
 <title> contact </title>
 <body>
 <div class="formulaire-contact">
    <h2>Contactez-nous</h2>
    <form action="processfeedback.php" method="post">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <input type="email" name="email" placeholder="Votre adresse email" required>
            <textarea name="commentaire" placeholder="Votre message..." required></textarea>
            <button type="submit">Envoyer</button>
    </form>
    </div>
 </body>
 </html>


