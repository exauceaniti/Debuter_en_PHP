<?php
include 'header.php';
// Tableau des produits : clé = image, valeur = tableau avec titre et prix
$produits = [
    'masekafood.png' => ['titre' => 'Maseka Food', 'prix' => 12],
    'Black-Forest-Gateau_Header.jpg' => ['titre' => 'Black Forest Gâteau', 'prix' => 15],
    'maseka.png'=> ['titre' => 'Maseka', 'prix' => 10],
    'gateau-d-anniversaire-aux-confettis.jpg'=> ['titre' => 'Gâteau Anniversaire Confettis', 'prix' => 18],
    'gateau_etage.png'=> ['titre' => 'Gâteau à Étages', 'prix' => 22],
    'Mini-gateaux-etages-au-chocolat.jpg'=> ['titre' => 'Mini Gâteaux Chocolat', 'prix' => 90],
    'summer_party_gateau_61495_16x9.jpg'=> ['titre' => 'Summer Party Gâteau', 'prix' => 16],
    '5-recettes-de-gateau-original.jpg'=> ['titre' => '5 Recettes de Gâteaux', 'prix' => 11],
    'gateau-simple.png'=> ['titre' => 'Gâteau Simple', 'prix' => 80],
    'Recettes-de-gateaux.jpg'=> ['titre' => 'Recettes de Gâteaux', 'prix' => 13],
    'produits.png'=> ['titre' => 'Produits Divers', 'prix' => 14],
    'gateau-au-chocolat.jpg' => ['titre' => 'Gâteau au Chocolat', 'prix' => 17],
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Produits - Maseka Food</title>
    <link rel="stylesheet" href="css/produit.css" />
</head>
<body>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Prix $</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $img => $info): ?>
                    <tr>
                        <td><img src="image/<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($info['titre']); ?>"></td>
                        <td><?php echo htmlspecialchars($info['titre']); ?></td>
                        <td><?php echo number_format($info['prix'], 0, ',', ' '); ?> $ </td>
                        <td>
                            <a class="commander-btn" href="commande.php?produit=<?php echo urlencode($img); ?>">Commander</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
