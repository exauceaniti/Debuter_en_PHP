<?php require 'header.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande - Garage de Exauce</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Maseka Food</h1>
    <form action="processorder.php" method="post">
        <table class="form-table">
            <tr>
                <td width="70%">Article</td>
                <td width="30%">Quantité</td>
            </tr>
            <tr>
                <td>Gateau d'anniversaire</td>
                <td><input type="text" name="qte_gateau1" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Gâteau Forêt Noire</td>
                <td><input type="text" name="qte_gateau2" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Gâteau Noire</td>
                <td><input type="text" name="qte_gateau3" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Gâteau d’anniversaire aux confettis</td>
                <td><input type="text" name="qte_gateau4" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Mini gâteaux étagés au chocolat</td>
                <td><input type="text" name="qte_gateau5" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Gâteau original</td>
                <td><input type="text" name="qte_gateau6" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Recettes variées de gâteaux</td>
                <td><input type="text" name="qte_gateau7" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Gâteau simple</td>
                <td><input type="text" name="qte_gateau8" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Produits assortis</td>
                <td><input type="text" name="qte_gateau9" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Gâteau au chocolat</td>
                <td><input type="text" name="qte_gateau10" size="3" maxlength="3"></td>
            </tr>



            <!-- Après les articles comme Volants et Portes -->
            <tr><td colspan="2"><strong>Informations de contact </strong></td></tr>

            <tr>
                <td>Adresse de livraison</td>
                <td><input type="text" name="adresse" size="40" maxlength="130" class="input-adresse"></td>
            </tr>
            <tr>
                <td>Téléphone</td>
                <td><input type="text" name="telephone" size="15" maxlength="13"></td>
            </tr>

        </table>
        <input type="submit" value="Envoyer la commande" class="submit-btn">
    </form>
</body>
</html>