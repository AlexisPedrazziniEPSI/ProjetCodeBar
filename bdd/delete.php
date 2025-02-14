<?php
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<body class="container">
<h1>Vous êtes sur le point de supprimer un produit</h1>
<h2>Êtes vous sûr ?</h2>
<!-- action="DELETEE.php" -->
<form method="post">
    <input type="submit" class="btn btn-danger" name="oui" value="Oui" />
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <a href="../produit.php" class="btn btn-secondary">Non</a>
</form>
</body>
</html>
<?php
if (isset($_POST['oui'])) {
    include '../config.php';
    $servername = config::SERVEUR;
    $username = config::UTILISATEUR;
    $password = config::MOTDEPASSE;
    $dbname = config::BASEDEDONNEES;

    #crée une co avec la bdd
    $conn = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES
        , Config::UTILISATEUR, Config::MOTDEPASSE);

    $recup = $conn->prepare("DELETE FROM produit WHERE id = :id");
    $recup->bindParam(':id', $id);
    $recup->execute();
    header("Location: ../produit.php");
}