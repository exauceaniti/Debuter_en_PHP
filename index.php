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
    <title>Le Garage de Bob</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #60bfe5ff;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        table {
            margin: auto;
            width: 50%;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
        }
        img {
            border: 2px solid #ccc;
            border-radius: 8px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0077cc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <h1> Le Garage de Exauce</h1>
    <table>
        <tr>
            <?php
            for ($i = 0; $i < 3; $i++) {
                echo '<td><img src="image/' . $images[$i] . '" width="200" height="200 
                border-radius: 10px;"></td>';
            }
            ?>
        </tr>
    </table>
    <a href="orderform.php"> Passer votre commande</a>
</body>
</html>