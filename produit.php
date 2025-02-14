<?php

include 'config.php';
$servername = config::SERVEUR;
$username = config::UTILISATEUR;
$password = config::MOTDEPASSE;
$dbname = config::BASEDEDONNEES;

#crée une co avec la bdd
$conn = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES
    , Config::UTILISATEUR, Config::MOTDEPASSE);

$recup = $conn->prepare("SELECT * FROM produit");
$recup->execute();
$recup->setFetchMode(PDO::FETCH_ASSOC);
$tab = $recup->fetchAll();
$invalide = 0;
$eh = 0;

?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pagee des Produits</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <?php
if ($tab == null) {
    ?>
    <div class="alert alert-danger">
        <strong>Attention !</strong> Il n'y à aucun produit !
    </div>
    <a class="btn btn-success" href="index.php">Ajouter d'autre produit</a>
    <?php
}
else {
    ?>
    <body class="container">
        <h1>Produit</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Contenance</th>
                    <th>Matière</th>
                    <th>Longueur</th>
                    <th>Hauteur</th>
                    <th>Largeur</th>
                    <th>Accessoires</th>
                    <th>Poids</th>
                    <th>Code barre</th>
                </tr>
            </thead>
            <?php
            foreach ($tab as $value) {
                if ($value['CodeBarreValide'] == 0) {
                    $invalide++;
                }
                if ($value['Titre'] == "GrosChat") {
                    global $eh;
                    $eh = 1;
                }
                ?>
                <tr>
                    <td><?php echo $value['Titre'] ?></td>
                    <td><?php echo $value['Description'] ?></td>
                    <td><?php echo $value['Contenance'] ?> Litres</td>
                    <td><?php echo $value['Matiere'] ?></td>
                    <td><?php echo $value['DimensionsL'] ?> cm</td>
                    <td><?php echo $value['DimensionsH'] ?> cm</td>
                    <td><?php echo $value['DimensionsP'] ?> cm</td>
                    <?php
                    if ($value['Accessoires'] == 1) {
                        echo "<td>✔️</td>";
                    }
                    else {
                        echo "<td>❌</td>";
                    }
                    ?>
                    <td><?php echo $value['Poids'] ?> kg</td>
                    <?php
                    if ($value['CodeBarreValide'] == 1) {
                        ?><td><?php echo $value['Codebar'] ?></td>
                        <?php
                    }
                    else {
                        ?>
                        <td style="color: red"><?php echo $value['Codebar'] ?></td>
                    <?php
                    }
                    ?>
                    <td>
                        <form action="Edit.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                            <input type="submit" class="btn btn-warning" value="Modifier">
                        </form>
                    </td>
                    <td>
                        <form action="bdd/delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                            <input type="submit" class="btn btn-danger" value="Supprimer">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
        if ($invalide >= 1) {
            ?>
            <div class="alert alert-danger">
                <strong>Attention !</strong> Il y à <?php echo $invalide ?> produit(s) avec un code barre invalide !
            </div>
            <?php
        }

        if ($eh == 1) {
            ?>
                <video width="500" height="500" src="eh/----.mp4" autoplay></video>
            <?php
        }
        ?>
        <a class="btn btn-success" href="index.php">Ajouter d'autre produit</a>
        <a class="btn btn-info" href="codebar_checker.php">Vérifier le code barre du produit</a>
        <a class="btn btn-secondary" href="bdd/CodeBarGen.php">Géneré un code barre</a>
    </body>
<?php
}