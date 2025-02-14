<?php
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="container">
    <form method="post">
        <div class="mb-3">
            <label for="codebar" class="form-label">Codebar (13 caractère)</label>
            <input type="text" class="form-control" name="codebar" id="codebar"><br>
        </div>
        <input type="submit" class="btn btn-primary" value="Envoyer">
    </form>
</body>
<?php

$cbar = filter_input(INPUT_POST, 'codebar', FILTER_SANITIZE_NUMBER_INT);

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
        echo "Le codebar est valide donc pas d'inquiétude";
    }
    else if ($code[12] == null) {
        echo "le 13ème chiffre du codebar est sensé être : $key";
    }
    else {
        echo "Le codebar n'est pas valide";
        echo "le 13ème chiffre du codebar est sensé être : $key";
    }
}

if (strlen($cbar) == 13) {
    EAN13($cbar);
}


?>
<br><br>
<a class="btn btn-success" href="index.php">Ajouter d'autre produit</a>
<a class="btn btn-success" href="produit.php">Voir les produits</a>
<a class="btn btn-success" href="bdd/CodeBarGen.php">Géneré un code barre</a>