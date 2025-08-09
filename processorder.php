<?php
require 'header.php';
/**
 * Script de traitement de commande pour le Garage de Exauce
 * 
 * Fonctionnalités :
 * 1. Récupère les données du formulaire envoyées via POST
 * 2. Calcule les montants des articles, les remises, et la TVA
 * 3. Génère un récapitulatif clair en HTML
 * 4. Enregistre les détails dans un fichier texte
 */
// SECTION 1 : RÉCUPÉRATION DES DONNÉES DU FORMULAIRE

// Récupération des quantités d'articles, converties en entier avec 0 comme valeur par défaut
$qte_pneus = isset($_POST['qte_pneus']) ? (int)$_POST['qte_pneus'] : 0;
$qte_huile = isset($_POST['qte_huile']) ? (int)$_POST['qte_huile'] : 0;
$qte_bougies = isset($_POST['qte_bougies']) ? (int)$_POST['qte_bougies'] : 0;
$qte_plaquettes = isset($_POST['qte_plaquettes']) ? (int)$_POST['qte_plaquettes'] : 0;
$qte_essuie_glaces = isset($_POST['qte_essuie_glaces']) ? (int)$_POST['qte_essuie_glaces'] : 0;
$qte_joints = isset($_POST['qte_joints']) ? (int)$_POST['qte_joints'] : 0;
$qte_thermostats = isset($_POST['qte_thermostats']) ? (int)$_POST['qte_thermostats'] : 0;
$qte_volants = isset($_POST['qte_volants']) ? (int)$_POST['qte_volants'] : 0;
$qte_portes = isset($_POST['qte_portes']) ? (int)$_POST['qte_portes'] : 0;

// Récupération de l'adresse de livraison et téléphone (avec protection XSS via htmlspecialchars)
$adresse = htmlspecialchars($_POST['adresse'] ?? '');
$telephone = htmlspecialchars($_POST['telephone'] ?? '');

// Pour le chemin de sauvegarde
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif de commande - Garage de Exauce</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Récapitulatif de commande</h2>
        <p>Date : <?php echo date('d/m/Y H:i'); ?></p>
    </div>

    <div class="info-box">
        <h3>Informations A propos de la livraison :</h3>
        <p><strong>Adresse de la livraison :</strong> <?php echo $adresse; ?></p>
        <p><strong>Téléphone : </strong><?php echo $telephone; ?></p>
    </div>

    <?php
    // SECTION 2 : TRAITEMENT DES ARTICLES ET CALCULS

    // Liste des articles disponibles avec leur prix unitaire
    $articles = [
        'Pneus' => ['quantite' => $qte_pneus, 'prix_unitaire' => 15000],
        'Huile' => ['quantite' => $qte_huile, 'prix_unitaire' => 12000],
        'Bougies' => ['quantite' => $qte_bougies, 'prix_unitaire' => 10000],
        'Plaquettes de frein' => ['quantite' => $qte_plaquettes, 'prix_unitaire' => 20000],
        'Essuie-glaces' => ['quantite' => $qte_essuie_glaces, 'prix_unitaire' => 25000],
        'Joints' => ['quantite' => $qte_joints, 'prix_unitaire' => 8000],
        'Thermostats' => ['quantite' => $qte_thermostats, 'prix_unitaire' => 35000],
        'Volants' => ['quantite' => $qte_volants, 'prix_unitaire' => 15000],
        'Portes' => ['quantite' => $qte_portes, 'prix_unitaire' => 20000]
    ];

    // Filtrer les articles commandés (quantité > 0) et calculer les montants
    $articles_commandes = [];
    $qte_totale = 0;
    $montant_total = 0;

    foreach ($articles as $nom => $details) {
        if ($details['quantite'] > 0) {
            $montant = $details['quantite'] * $details['prix_unitaire'];
            $articles_commandes[$nom] = [
                'quantite' => $details['quantite'],
                'prix_unitaire' => $details['prix_unitaire'],
                'montant' => $montant
            ];
            $qte_totale += $details['quantite'];
            $montant_total += $montant;
        }
    }

    // Si aucun article n'est commandé, on affiche un message et on arrête l'exécution
    if (empty($articles_commandes)) {
        echo '<p style="color: red;">Aucun article commandé.</p>';
        echo '<p><a href="orderform.php">Cliquez ici pour Repasser votre commande</a></p>';
        exit;
    }

    // Calcul de la remise en fonction du montant total HT
    $pourcentage_remise = 0;
    if ($montant_total > 1000) {
        $pourcentage_remise = 15;
    } elseif ($montant_total > 500) {
        $pourcentage_remise = 10;
    } elseif ($montant_total > 200) {
        $pourcentage_remise = 5;
    }

    $montant_remise = ($montant_total * $pourcentage_remise) / 100;
    $montant_apres_remise = $montant_total - $montant_remise;

    // Calcul de la TVA à 15%
    $taux_taxes = 0.15;
    $montant_taxes = $montant_apres_remise * $taux_taxes;
    $montant_total_final = $montant_apres_remise + $montant_taxes;

    // SECTION 3 : GÉNÉRATION DU TABLEAU HTML RÉCAPITULATIF

    echo '<table class="excel-table">
        <thead>
            <tr>
                <th>Article</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($articles_commandes as $nom => $details) {
        echo '<tr>
            <td>'.$nom.'</td>
            <td>'.$details['quantite'].'</td>
            <td class="money">'.number_format($details['prix_unitaire'], 2, ',', ' ').' Franc</td>
            <td class="money">'.number_format($details['montant'], 2, ',', ' ').' Franc</td>
        </tr>';
    }

    // Ligne séparatrice esthétique
    echo '<tr><td colspan="4" style="border: none; height: 1px; background-color: #ddd;"></td></tr>';

    // Affichage des totaux
    echo '<tr class="total-row">
            <td colspan="3">Montant total HT</td>
            <td class="money">'.number_format($montant_total, 2, ',', ' ').' Franc</td>
        </tr>';

    if ($pourcentage_remise > 0) {
        echo '<tr class="total-row">
                <td colspan="3">Remise ('.$pourcentage_remise.'%)</td>
                <td class="money">-'.number_format($montant_remise, 2, ',', ' ').' Franc</td>
            </tr>
            <tr class="total-row">
                <td colspan="3">Montant après remise</td>
                <td class="money">'.number_format($montant_apres_remise, 2, ',', ' ').' Franc</td>
            </tr>';
    }

    echo '<tr class="total-row">
            <td colspan="3">TVA ('.($taux_taxes*100).'%)</td>
            <td class="money">'.number_format($montant_taxes, 2, ',', ' ').' Franc</td>
        </tr>
        <tr class="total-row">
            <td colspan="3"><strong>MONTANT TOTAL TTC</strong></td>
            <td class="money"><strong>'.number_format($montant_total_final, 2, ',', ' ').' Franc</strong></td>
        </tr>';

    echo '</tbody></table>';

    // SECTION 4 : SAUVEGARDE DE LA COMMANDE DANS UN FICHIER TEXTE
    
        $chemin_fichier = $DOCUMENT_ROOT . "/orders/commande.txt";

        // Vérifie si le dossier existe, sinon le créer
        if (!file_exists(dirname($chemin_fichier))) {
            mkdir(dirname($chemin_fichier), 0777, true);
        }

        // Construire le tableau texte à sauvegarder
        $contenu = "===================== COMMANDE DU ".date('d/m/Y H:i')." =====================\n";
        $contenu .= "Adresse Client : $adresse\n";
        $contenu .= "Téléphone : $telephone\n\n";

        $contenu .= str_pad("Article", 25)
                . str_pad("Quantité", 10)
                . str_pad("Prix U", 12)
                . str_pad("Montant", 15) . "\n";

        $contenu .= str_repeat("-", 62)."\n";

        foreach ($articles_commandes as $nom => $details) {
            $contenu .= str_pad($nom, 25)
                    . str_pad($details['quantite'], 10)
                    . str_pad(number_format($details['prix_unitaire'], 2, ',', ' '), 12)
                    . str_pad(number_format($details['montant'], 2, ',', ' '), 15) . "\n";
        }

        $contenu .= str_repeat("-", 62)."\n";
        $contenu .= "Montant Total HT : ".number_format($montant_total, 2, ',', ' ')." Franc\n";

        if ($pourcentage_remise > 0) {
            $contenu .= "Remise ($pourcentage_remise%) : -".number_format($montant_remise, 2, ',', ' ')." Franc\n";
            $contenu .= "Montant après remise : ".number_format($montant_apres_remise, 2, ',', ' ')." Franc\n";
        }

        $contenu .= "TVA (15%) : ".number_format($montant_taxes, 2, ',', ' ')." Franc\n";
        $contenu .= "MONTANT TOTAL TTC : ".number_format($montant_total_final, 2, ',', ' ')." Franc\n\n\n";

        // Enregistre dans le fichier (mode append pour ne pas écraser les anciennes commandes)
        file_put_contents($chemin_fichier, $contenu, FILE_APPEND);

    ?>
   

</body>
</html> 