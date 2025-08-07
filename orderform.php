<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande - Garage de Exauce</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Commande - Garage de Exauce</h1>
    <form action="processorder.php" method="post">
        <table class="form-table">
            <tr>
                <td width="70%">Article</td>
                <td width="30%">Quantité</td>
            </tr>
            <tr>
                <td>Pneus</td>
                <td><input type="text" name="qte_pneus" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Huile</td>
                <td><input type="text" name="qte_huile" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Bougies</td>
                <td><input type="text" name="qte_bougies" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Plaquettes de frein</td>
                <td><input type="text" name="qte_plaquettes" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Essuie-glaces</td>
                <td><input type="text" name="qte_essuie_glaces" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Joints</td>
                <td><input type="text" name="qte_joints" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Thermostats</td>
                <td><input type="text" name="qte_thermostats" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Volants</td>
                <td><input type="text" name="qte_volants" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Portes</td>
                <td><input type="text" name="qte_portes" size="3" maxlength="3"></td>
            </tr>
            <tr>
                <td>Adresse de livraison </td>
                <td><input type="text" name="adresse" size="3" maxlength=""></td>
            </tr>
            <tr>
                <td>Telephone</td>
                <td><input type="text" name="telephone" size="3" maxlength="13"></td>
            </tr>
            
           
        </table>
        <input type="submit" value="Envoyer la commande" class="submit-btn">
    </form>
</body>
</html>