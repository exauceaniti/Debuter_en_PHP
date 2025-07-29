<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultat de la commande</title>
</head>
<body>
    <h1> Ici s'affiche le resultat de votre commande </h1>
    <?php
   
    //recuperation des valeurs du formulaire
    //on verifie si les valeurs existent
    //et on les convertit en entier
    //si elles n existent pas, on les initialise a 0
    $qte_pneus = isset($_POST['qte_pneus']) ? (int)$_POST['qte_pneus'] : 0;
    $qte_huiles = isset($_POST['qte_huiles']) ? (int)$_POST['qte_huiles'] : 0;
    $qte_bougies = isset($_POST['qte_bougies']) ? (int)$_POST['qte_bougies'] : 0;


    $qte_total = 0 ;
    $qte_total = $qte_pneus + $qte_huiles + $qte_bougies;

    
    //si aucune quantite n a ete saisie on affiche un message d erreur 
    if (0 == $qte_pneus && 0 == $qte_huiles && 0 == $qte_bougies) {
        echo '<p style="color: red;"> ';
        echo 'Vous n avez passer aucune commande';
        echo '</p>';
        echo '<p> <a href="orderform.html"> Cliquez ici 
                        pour repasser a nouveau votre commande </a> </p>';
                        exit;
    }
    //sinon on affiche le recapitulatif de la commande et le montant 
    else {
        echo "<p> Commande trraitee le: ";
        echo date('H:i:s, \l\e d/m/y'); "</p>";
        echo '<p style="color: green;"> ';
        echo 'Recaputilatifs de votre commande </p>';
        echo 'Article commander : '.$qte_total. '<br>';
        echo "$qte_pneus  pneus <br>";
        echo "$qte_huiles bidon d huiles <br>";
        echo "$qte_bougies bougies <br>";

    }

    //calcul du montant sans taxes et avec taxes de la commande
    echo '<p> Prix a payer pour votre commande </p>';
    $montant_total =0.00;
    define('PRIX_PNEU', 15);
    define('PRIX_HUILE', 10);
    define('PRIX_BOUGIE', 5);
    $montant_total = ($qte_pneus * PRIX_PNEU) 
                    + ($qte_huiles * PRIX_HUILE)
                    + ($qte_bougies * PRIX_BOUGIE);

    //Determination de pourcentage de la remise
    $pourcentage_remise = 0;

    if($qte_pneus < 10) 
        $pourcentage_remise = 0;
    elseif($qte_pneus >= 10 && $qte_pneus <= 49 ) 
        $pourcentage_remise = 5;
    elseif($qte_pneus >= 50 && $qte_pneus <= 99 ) 
        $pourcentage_remise = 10;
    elseif($qte_pneus >= 100 ) 
        $pourcentage_remise = 15; 

    //Calcul et affichage de la remise selon le pourcentage et le montant total
    $montant_remise = ($montant_total * $pourcentage_remise) / 100;
    $montant_total_final = $montant_total - $montant_remise;

    //calcule du sous total apres remise
    echo 'Montant totale de la commande apres remise sans taxe: ' . number_format($montant_total_final, 2). ' Dollars<br>';

    if ($montant_remise > 0) {
        echo '<p style="color: blue;"> Remise appliquer de : ' .number_format($montant_remise, 2) . ' Dollars (' . $pourcentage_remise . '%)</p>';
    
    }
     
     //calcule du montant avec taxes et remise
     $taux_taxes = 0.15;
     $montant_total_apres_remie_et_taxes = $montant_total_final * (1 + $taux_taxes);
     echo 'Montant total de votre commande apres remise et taxes: ' . number_format($montant_total_apres_remie_et_taxes, 2) . ' Dollars<br>';

    ?>
</body>
</html>