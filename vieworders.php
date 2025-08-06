<?php
        //création du nom de variable abrégé
        $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
    ?>

<html>
<head>
    <title>Le garage de Exau - Commandes des clients</title>
    </head>
    <body>
        <h1>Le garage de Exau</h1>
        <h2>Commandes des clients</h2>
    <?php
    
        @$fp = fopen("DOCUMENT_ROOT/../orders/commande.txt", 'rb');
    
        if (!$fp)
        {
        echo '<p><strong>Aucune commande en attente.'
        . 'Essayez plus tard.</strong></p>';
        exit;
        }
        while (!feof($fp))
        {
        $commande = fgets($fp, 999);
        echo $commande . '<br />';
        }
        fclose($fp);
    ?>

</body>
</html>