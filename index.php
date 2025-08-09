<?php
require 'header.php';
    $images = [

        'masekafood.png' => 'masekafood',
        'Black-Forest-Gateau_Header.jpg' => 'Black-Forest-Gateau_Header',
        'maseka.png'=> 'maseka',
        'gateau-d-anniversaire-aux-confettis.jpg'=> 'gateau-d-anniversaire-aux-confettis',
        'gateau_etage.png'=> 'gateau_etage',
        'Mini-gateaux-etages-au-chocolat.jpg'=> 'Mini-gateaux-etages-au-chocolat',
        'summer_party_gateau_61495_16x9.jpg'=> 'summer_party_gateau_61495_16x9',
        '5-recettes-de-gateau-original.jpg'=> '5-recettes-de-gateau-original',
        'gateau-simple.png'=> 'gateau-simple',
        'Recettes-de-gateaux.jpg'=> 'Recettes-de-gateaux',
        'produits.png'=> 'produits',
        'gateau-au-chocolat.jpg' => 'gateau-au-chocolat',
    ];
    $keys = array_keys($images);
    shuffle($keys);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Le Garage de Exauce</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>MAseka Food</h1>

     <table>
        <?php
        $count = 0;
        foreach ($keys as $key) {
            if ($count % 3 === 0) echo "<tr>"; // nouvelle ligne toutes les 3 images
            echo '<td><img src="image/' . $key . '" alt="' . $images[$key] . '" title="' . 
            $images[$key] . '"></td>';
            $count++;
            if ($count % 3 === 0) echo "</tr>";
        }
        ?>
    </table>

</body>
</html>
