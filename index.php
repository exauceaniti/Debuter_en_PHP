<?php
    $images = [
        'pneu.png' => 'Pneu',
        'huile.png' => 'Bidon d\'huile ',
        'bougie.jpg'=> 'Bougies',
        'essuie_glace.jpeg'=> 'Essuie_Glace',
        'joint.jpeg'=> 'Joint',
        'plaquette_frein.jpg'=> 'Plaquette de Frein',
        'porte.jpg'=> 'Porte',
        'thermostat.jpg'=> 'Thermostat',
        'volant.jpg'=> 'Volant',
    ];
    $keys = array_keys($images);
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

    <a href="orderform.php">Passer votre commande</a>
</body>
</html>
