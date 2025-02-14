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
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$eanv = filter_input(INPUT_POST, 'eanv', FILTER_SANITIZE_NUMBER_INT);

#en cas dde changement de code bar vérifier qu'il est correcte
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
    if ($key == $code[12]) {
        global $eanv;
        $eanv = 1;
    }
    else {
        global $eanv;
        $eanv = 0;
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

#update les données
$bdd =  $conn->prepare("UPDATE produit SET Titre = :titre, 
                   Description = :Desc, 
                   Contenance = :Contenu, 
                   Matiere = :matiere, 
                   DimensionsL = :diml, 
                   DimensionsH = :dimh, 
                   DimensionsP = :dimp, 
                   Accessoires = :accesse, 
                   Poids = :poids, 
                   Codebar = :ean,
                   CodeBarreValide = :eanv
               WHERE id = :id");
$bdd->bindParam(':titre', $marque);
$bdd->bindParam(':Desc', $Descer);
$bdd->bindParam(':Contenu', $refe);
$bdd->bindParam(':matiere', $fournisseur);
$bdd->bindParam(':diml', $diml);
$bdd->bindParam(':dimh', $dimh);
$bdd->bindParam(':dimp', $dimp);
$bdd->bindParam(':accesse', $promo);
$bdd->bindParam(':poids', $poids);
$bdd->bindParam(':ean', $ean);
$bdd->bindParam(':id', $id);
$bdd->bindParam(':eanv', $eanv);
$bdd->execute();

echo "Le produit a bien été modifié";
echo "<br>";
echo "Vous allez être redirigé vers la page des produits";
header("refresh:3;url=../produit.php");