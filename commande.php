<?php
include 'header.php';
// Récupérer le produit choisi en GET
$produitChoisi = $_GET['produit'] ?? null;

// Tableau produit (image => titre, prix)
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

// Vérifier que produit existe
if (!$produitChoisi || !isset($produits[$produitChoisi])) {
    echo "Produit non valide.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Commander - Maseka Food</title>
    <link rel="stylesheet" href="css/commande.css"/>
    
</head>
<body>

    <h1>Passer commande pour : <?php echo htmlspecialchars($produits[$produitChoisi]['titre']); ?></h1>

    <div class="produit-info">
        <img src="image/<?php echo htmlspecialchars($produitChoisi); ?>" alt="<?php echo htmlspecialchars($produits[$produitChoisi]['titre']); ?>">
        <p><strong>Produit :</strong> <?php echo htmlspecialchars($produits[$produitChoisi]['titre']); ?></p>
        <p><strong>Prix unitaire :</strong> <?php echo number_format($produits[$produitChoisi]['prix'], 0, ',', ' '); ?> CDF</p>
    </div>

    <form action="traitement_commande.php" method="post">
        <input type="hidden" name="produit" value="<?php echo htmlspecialchars($produitChoisi); ?>">

        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" id="quantite" value="1" min="1" required>

        <label for="nom">Nom complet :</label>
        <input type="text" id="nom" name="nom" placeholder="Votre nom" required>

        <label for="adresse">Adresse :</label>
        <textarea id="adresse" name="adresse" rows="3" placeholder="Votre adresse complète ici" required></textarea>

        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" placeholder="Numéro de téléphone" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="Votre email" required>

        <button type="submit">Confirmer</button>
    </form>
</body>
</html>
