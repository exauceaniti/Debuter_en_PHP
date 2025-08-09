    <?php
    // Tableau des produits avec titre et prix
    $produits = [
        'masekafood.png' => ['titre' => 'Maseka Food', 'prix' => 1200],
        'Black-Forest-Gateau_Header.jpg' => ['titre' => 'Black Forest Gâteau', 'prix' => 1500],
        'maseka.png'=> ['titre' => 'Maseka', 'prix' => 1000],
        'gateau-d-anniversaire-aux-confettis.jpg'=> ['titre' => 'Gâteau Anniversaire Confettis', 'prix' => 1800],
        'gateau_etage.png'=> ['titre' => 'Gâteau à Étages', 'prix' => 2200],
        'Mini-gateaux-etages-au-chocolat.jpg'=> ['titre' => 'Mini Gâteaux Chocolat', 'prix' => 900],
        'summer_party_gateau_61495_16x9.jpg'=> ['titre' => 'Summer Party Gâteau', 'prix' => 1600],
        '5-recettes-de-gateau-original.jpg'=> ['titre' => '5 Recettes de Gâteaux', 'prix' => 1100],
        'gateau-simple.png'=> ['titre' => 'Gâteau Simple', 'prix' => 800],
        'Recettes-de-gateaux.jpg'=> ['titre' => 'Recettes de Gâteaux', 'prix' => 1300],
        'produits.png'=> ['titre' => 'Produits Divers', 'prix' => 1400],
        'gateau-au-chocolat.jpg' => ['titre' => 'Gâteau au Chocolat', 'prix' => 1700],
    ];

    // Récupérer les données POST
    $produit = $_POST['produit'] ?? '';
    $quantite = $_POST['quantite'] ?? '';
    $nom = trim($_POST['nom'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');
    $email = trim($_POST['email'] ?? '');

    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

    // Vérifier que le produit est valide
    if (!isset($produits[$produit])) {
        die("Produit non valide.");
    }

    // Valider les autres champs basiques
    $errors = [];
    if ($quantite === '' || !filter_var($quantite, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $errors[] = "Quantité invalide.";
    }
    if (empty($nom)) {
        $errors[] = "Le nom est obligatoire.";
    }
    if (empty($adresse)) {
        $errors[] = "L'adresse est obligatoire.";
    }
    if (empty($telephone)) {
        $errors[] = "Le téléphone est obligatoire.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email invalide.";
    }

    if (!empty($errors)) {
        echo "<h2>Erreur dans le formulaire :</h2><ul>";
        foreach ($errors as $err) {
            echo "<li>" . htmlspecialchars($err) . "</li>";
        }
        echo "</ul>";
        echo '<p><a href="javascript:history.back()">Retour</a></p>';
        exit;
    }

    // Calculer le prix total
    $prixUnitaire = $produits[$produit]['prix'];
    $prixTotal = $prixUnitaire * (int)$quantite;

    // Générer un numéro de commande simple (timestamp + random)
    $numCommande = strtoupper(substr(md5(time() . rand()), 0, 8));
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Confirmation de commande - Maseka Food</title>
        <link rel="stylesheet" href="traitement_commande.css" />
    </head>
    <body>
        <div class="confirmation">
            <h1>Commande confirmée !</h1>
            <p>Merci <strong><?php echo htmlspecialchars($nom); ?></strong> pour votre commande.</p>
            <p>Numéro de commande : <strong><?php echo $numCommande; ?></strong></p>

            <table>
                <tr><th>Produit</th><td><?php echo htmlspecialchars($produits[$produit]['titre']); ?></td></tr>
                <tr><th>Quantité</th><td><?php echo (int)$quantite; ?></td></tr>
                <tr><th>Prix unitaire</th><td><?php echo number_format($prixUnitaire, 0, ',', ' '); ?> CDF</td></tr>
                <tr><th>Prix total</th><td><strong><?php echo number_format($prixTotal, 0, ',', ' '); ?> CDF</strong></td></tr>
                <tr><th>Adresse</th><td><?php echo nl2br(htmlspecialchars($adresse)); ?></td></tr>
                <tr><th>Téléphone</th><td><?php echo htmlspecialchars($telephone); ?></td></tr>
                <tr><th>Email</th><td><?php echo htmlspecialchars($email); ?></td></tr>
            </table>

            <a href="index.php" class="button-back">Retour à l'accueil</a>
        </div>


        <?php

                // Fichier où on stocke les commandes en JSON
    
            $fichierCommande = __DIR__ . '/orders/commande.txt';

            // Charger commandes existantes
            if (file_exists($fichierCommande)) {
                $commandes = include $fichierCommande;
                if (!is_array($commandes)) {
                    $commandes = [];
                }
            } else {
                $commandes = [];
            }

            // Préparer la nouvelle commande
            $nouvelleCommande = [
                'numCommande' => $numCommande,
                'produit' => $produits[$produit]['titre'],
                'quantite' => (int)$quantite,
                'prixUnitaire' => $prixUnitaire,
                'prixTotal' => $prixTotal,
                'nom' => $nom,
                'adresse' => $adresse,
                'telephone' => $telephone,
                'email' => $email,
                'date' => date('d/m/Y H:i:s'),
            ];

            // Ajouter la nouvelle commande
            $commandes[] = $nouvelleCommande;

            // Générer le code PHP à écrire dans le fichier
            $contenuPHP = "<?php\nreturn " . var_export($commandes, true) . ";\n";

            // Écrire dans le fichier (avec verrouillage)
            file_put_contents($fichierCommande, $contenuPHP, LOCK_EX);


    ?>
    </body>
    </html>
