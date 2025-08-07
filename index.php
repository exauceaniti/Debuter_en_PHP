<?php
    $images = [
        'pneu.png', 'huile.png', 'bougie.jpg',
        'porte.jpg', 'volant.jpg',
        'thermostat.jpg', 'essuie_glace.jpeg',
        'joint.jpeg', 'plaquette_frein.jpg'
    ];
    shuffle($images);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Le Garage de Exauce</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Le Garage de Exauce</h1>

    <table>
        <tr>
            <?php
            for ($i = 0; $i < 3; $i++) {
                echo '<td><img src="image/' . $images[$i] . '" alt="Image ' . ($i+1) . '"></td>';
            }
            ?>
        </tr>
    </table>

    <a href="orderform.php">Passer votre commande</a>
</body>
</html>
