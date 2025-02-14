<?php
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KeyGen de Code Barre tkt 100% sans virus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="container">
<form method="post">
    <input type="submit" class="btn btn-primary" name="submit" value="Générer un code barre valide" />
    <input type="submit" class="btn btn-danger" name="submit2" value="Générer un code barre invalide" />
</form>

<?php
if (isset($_POST['submit'])) {
    $ean13 = GenEAN13();
    echo '<div class="mb-3">';
    echo '<label for="codeEAN13" class="form-label">Code barre généré</label>';
    echo '<input type="text" class="form-control" id="codeEAN13" value="' . $ean13 . '" readonly>';
    echo '</div>';
}

if (isset($_POST['submit2'])) {
    $ean13 = InvalGenEAN13();
    echo '<div class="mb-3">';
    echo '<label for="codeEAN13" class="form-label">Code barre généré</label>';
    echo '<input type="text" class="form-control" id="codeEAN13" value="' . $ean13 . '" readonly>';
    echo '</div>';
}

function GenEAN13() {
    $code = rand(100000000000, 999999999999);
    $code = str_split($code);
    $code = array_map('intval', $code);
    $pairsum = 0;
    $impairsum = 0;
    for ($i = 0; $i < 12; $i++) {
        if ($i % 2 == 0) {
            $pairsum += $code[$i];
        } else {
            $impairsum += $code[$i];
        }
    }
    $PouletPiment = $impairsum * 3;
    $sum = $pairsum + $PouletPiment;
    $key = 10 - ($sum % 10);
    $code[12] = $key;
    $code = implode($code);
    if (strlen($code) == 14) {
        GenEAN13();
    }
    else{
    return $code;
    }
}

function EAN13($code)
{
    $code = str_split($code);
    $code = array_map('intval', $code);
    $pairsum = 0;
    $impairsum = 0;
    for ($i = 0; $i < 12; $i++) {
        if ($i % 2 == 0) {
            $pairsum += $code[$i];
        } else {
            $impairsum += $code[$i];
        }
    }
    $bourpi = $impairsum * 3;

    $sum = $pairsum + $bourpi;
    $key = 10 - ($sum % 10);
    if ($key == $code[12]) {
        return true;
    }
    else {
        return false;
    }
}

function InvalGenEAN13() {
    $code = rand(1000000000000, 9999999999999);
    $code = str_split($code);
    $code = array_map('intval', $code);
    $code = implode($code);
    if (EAN13($code) == true) {
        InvalGenEAN13();
        echo "omg c'est un miracle sa à fait un code barre valide ta de la chance mon gars";
    }
    else {
        return $code;
    }
}
?>
<a class="btn btn-success" href="../produit.php">Voir les produits</a>
<a class="btn btn-success" href="../index.php">Ajouter d'autre produit</a>
<a class="btn btn-success" href="../codebar_checker.php">Vérifié le code barre</a>
</body>
