<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="processorder.php" method="post">
        <table border=0>
            <tr bgcolor="#f2f2f2">
                <td widith="150">Article</td>
                <td widith="15">Quantite</td>
            </tr>
            <tr>
                <td>Pneus</td>
                <td align="center">
                    <input type="text" name="qte_pneus" size="3" maxlength="3">
                </td>
            </tr>
            <tr>
                <td>Huiles</td>
                <td align="center">
                    <input type="text" name="qte_huiles" size="3" maxlength="3">
                </td>
            </tr>
            <tr>
                <td>Bougies</td>
                <td align="center">
                    <input type="text" name="qte_bougies" size="3" maxlength="3">
                </td>
            </tr>

            <tr>
                <td> Comment avez vous eu <br> connaissance de notre site ? </td>
                <td align="center">
                    <input type="tex" name="adresse" size="30" maxlength="50">
                </td>
            </tr>

            <tr>
                <td colspan="2" border=0 align="center">
                    <input type="submit" value="Envoyer la commande">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>