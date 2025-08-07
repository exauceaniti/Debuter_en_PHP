<?php
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commandes | Garage de Exauce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f3;
            padding: 20px;
        }
        h1, h2 {
            color: #333;
        }
        .commande {
            background-color: #fff;
            border: 2px solid #aaa;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .commande h3 {
            margin-top: 0;
            color: #005f73;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #ddd;
        }
        .total, .remise, .ttc {
            font-weight: bold;
        }
        .footer {
            margin-top: 10px;
        }
        .no-command {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1> Commandes des Clients</h1>
    <h2>Garage de Exauce</h2>

    <?php
        @ $chemin_fichier = $DOCUMENT_ROOT . "/orders/commande.txt";

        if (!file_exists($chemin_fichier)) {
            echo '<p class="no-command">Aucune commande enregistrée.</p>';
            exit;
        }

        $contenu = file_get_contents($chemin_fichier);

        // Capturer chaque bloc complet de commande (avec la date incluse)
        preg_match_all('/=+ COMMANDE DU (.*?) =+\n(.*?)(?==+ COMMANDE DU|\z)/s', $contenu, $matches, PREG_SET_ORDER);

        if (!$matches) {
            echo '<p class="no-command">Aucune commande valide trouvée.</p>';
        }

        foreach ($matches as $commande) {
            $date_commande = trim($commande[1]);
            $bloc = trim($commande[2]);

            echo "<div class='commande'>";
            echo "<h3>Commande du $date_commande</h3>";

            // Séparer les lignes
            $lignes = explode("\n", $bloc);
            $client_info = [];
            $articles = [];
            $totaux = [];

            foreach ($lignes as $ligne) {
                $ligne = trim($ligne);

                if (stripos($ligne, "Adresse Client") === 0) {
                    $client_info['Adresse'] = explode(":", $ligne, 2)[1] ?? '';
                } elseif (stripos($ligne, "Téléphone") === 0) {
                    $client_info['Téléphone'] = explode(":", $ligne, 2)[1] ?? '';
                } elseif (preg_match('/Montant Total HT|Remise|après remise|TVA|MONTANT TOTAL TTC/', $ligne)) {
                    $totaux[] = $ligne;
                } elseif (preg_match('/^\-+$/', $ligne)) {
                    continue; 
                } elseif (!empty($ligne) && !str_starts_with($ligne, "Article")) {
                    $col = preg_split('/\s{2,}/', $ligne);
                    if (count($col) === 4) {
                        $articles[] = $col;
                    }
                }
            }

            // Affichage client
            echo "<p><strong>Adresse :</strong> {$client_info['Adresse']}</p>";
            echo "<p><strong>Téléphone :</strong> {$client_info['Téléphone']}</p>";

            // Tableau articles
            if (count($articles) > 0) {
                echo "<table>
                        <tr>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th>Montant</th>
                        </tr>";
                foreach ($articles as $a) {
                    echo "<tr>
                            <td>{$a[0]}</td>
                            <td>{$a[1]}</td>
                            <td>{$a[2]}</td>
                            <td>{$a[3]}</td>
                        </tr>";
                }
                echo "</table>";
            }

            // Affichage totaux
            if (!empty($totaux)) {
                echo "<div class='footer'>";
                foreach ($totaux as $ligne) {
                    echo "<p class='ttc'>" . htmlspecialchars($ligne) . "</p>";
                }
                echo "</div>";
            }

            echo "</div>"; 
        }

    ?>
</body>
</html>
