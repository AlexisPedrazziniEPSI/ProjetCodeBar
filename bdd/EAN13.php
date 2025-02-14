<?php
if(isset($_POST['Submit'])) {
    header("Location: index.php");
}

$marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$Descer = filter_input(INPUT_POST, 'Descer', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$refe = filter_input(INPUT_POST, 'refe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$fournisseur = filter_input(INPUT_POST, 'fournisseur', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$diml = filter_input(INPUT_POST, 'diml', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$dimh = filter_input(INPUT_POST, 'dimh', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$dimp = filter_input(INPUT_POST, 'dimp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$promo = filter_input(INPUT_POST, 'promo', FILTER_VALIDATE_BOOLEAN);
$poids = filter_input(INPUT_POST, 'poids', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$ean = filter_input(INPUT_POST, 'ean', FILTER_SANITIZE_NUMBER_INT);
$CodeBarreValide = 0;
function EAN13($code)
{
    $code = str_split($code);
    $code = array_map('intval', $code);
    $apirsum = 0;
    $impairsum = 0;
    for ($i = 0; $i < 12; $i++) {
        if ($i % 2 == 0) {
            $apirsum += $code[$i];
        } else {
            $impairsum += $code[$i];
        }
    }
    $bourpi = $impairsum * 3;

    $sum = $apirsum + $bourpi;
    $key = 10 - ($sum % 10);
    echo $key;
    if ($key == $code[12]) {
        global $CodeBarreValide;
        return $CodeBarreValide = 1;
    }
    else {
        global $CodeBarreValide;
        return $CodeBarreValide = 0;
    }
}
EAN13($ean);

include '../config.php';
$servername = config::SERVEUR;
$username = config::UTILISATEUR;
$password = config::MOTDEPASSE;
$dbname = config::BASEDEDONNEES;

#crée une co avec la bdd
$conn = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES
    , Config::UTILISATEUR, Config::MOTDEPASSE);

$bdd =  $conn->prepare("INSERT INTO produit (Titre, Description, Contenance, Matiere, DimensionsL, DimensionsH, DimensionsP, Accessoires, Poids, Codebar, CodeBarreValide) VALUES (:titre, :Desc, :Contenu, :matier, :diml, :dimh, :dimp, :accesse, :poids, :ean, :eanv)");
$bdd->bindParam(':titre', $marque);
$bdd->bindParam(':Desc', $Descer);
$bdd->bindParam(':Contenu', $refe);
$bdd->bindParam(':matier', $fournisseur);
$bdd->bindParam(':diml', $diml);
$bdd->bindParam(':dimh', $dimh);
$bdd->bindParam(':dimp', $dimp);
$bdd->bindParam(':accesse', $promo);
$bdd->bindParam(':poids', $poids);
$bdd->bindParam(':ean', $ean);
$bdd->bindParam(':eanv', $CodeBarreValide);
$bdd->execute();

header("Location: ../produit.php");