<?php
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

include 'config.php';
$servername = config::SERVEUR;
$username = config::UTILISATEUR;
$password = config::MOTDEPASSE;
$dbname = config::BASEDEDONNEES;

#crée une co avec la bdd
$conn = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES
    , Config::UTILISATEUR, Config::MOTDEPASSE);

$recup = $conn->prepare("SELECT * FROM produit WHERE id = :id");
$recup->bindParam(':id', $id);
$recup->execute();
$recup->setFetchMode(PDO::FETCH_ASSOC);
$tab = $recup->fetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Me regarde pas comme ça !</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="container">
<h1>Produit</h1>
<?php
foreach ($tab as $value) {

?>
    <form action="bdd/editor.php" method="post">
        <div class="mb-3">
            <label for="marque" class="form-label">Nom du produit</label>
            <input type="text" class="form-control" name="marque" id="marque" value="<?php echo $value['Titre'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="Descer" class="form-label">Description du produit</label>
            <input type="text" class="form-control" name="Descer" id="Descer" value="<?php echo $value['Description'] ?>" required>
        </div>

        <div class="mb-3" >
            <label for="fournisseur" class="form-label">Matière composant le produit</label>
            <input type="text" class="form-control" name="fournisseur" id="fournisseur" value="<?php echo $value['Matiere'] ?>">
        </div>

        <div class="mb-3">
            <label for="diml" class="form-label">Longueur du produit</label>
            <input type="text" class="form-control" name="diml" id="diml" value="<?php echo $value['DimensionsL'] ?>" required>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var formulaire = document.getElementById('formulaire');

                    formulaire.addEventListener('submit', function (event) {
                        var champValeur = document.getElementById('diml');

                        // Vérifie si la valeur est négative ou égale à zéro car bah c'est pas possible enfaite mec
                        if (parseInt(champValeur.value) <= 0) {
                            champValeur.setCustomValidity("Veuillez saisir un nombre positif dans le champ 'Longueur du produit'.");
                            event.preventDefault(); // Empêche l'envoi du formulaire sinon ça vva faire bizzare
                        } else {
                            champValeur.setCustomValidity(""); // Réinitialise la validation personnalisée si la condition est fausse
                        }
                        //reset la validation personnalisée
                        champValeur.addEventListener('input', function () {
                            champValeur.setCustomValidity("");
                        });
                    });
                });
            </script>
        </div>

        <div class="mb-3">
            <label for="dimh" class="form-label">Hauteur du produit</label>
            <input type="text" class="form-control" name="dimh" id="dimh" value="<?php echo $value['DimensionsH'] ?>" required>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var formulaire = document.getElementById('formulaire');

                    formulaire.addEventListener('submit', function (event) {
                        var champValeur = document.getElementById('dimh');

                        // Vérifie si la valeur est négative ou égale à zéro car bah c'est pas possible enfaite mec
                        if (parseInt(champValeur.value) <= 0) {
                            champValeur.setCustomValidity("Veuillez saisir un nombre positif dans le champ 'Hauteur du produit'.");
                            event.preventDefault(); // Empêche l'envoi du formulaire sinon ça vva faire bizzare
                        } else {
                            champValeur.setCustomValidity(""); // Réinitialise la validation personnalisée si la condition est fausse
                        }
                        //reset la validation personnalisée
                        champValeur.addEventListener('input', function () {
                            champValeur.setCustomValidity("");
                        });
                    });
                });
            </script>
        </div>

        <div class="mb-3">
            <label for="dimp" class="form-label">Largeur du produit</label>
            <input type="text" class="form-control" name="dimp" id="dimp" value="<?php echo $value['DimensionsP'] ?>" required>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var formulaire = document.getElementById('formulaire');

                    formulaire.addEventListener('submit', function (event) {
                        var champValeur = document.getElementById('dimp');

                        // Vérifie si la valeur est négative ou égale à zéro car bah c'est pas possible enfaite mec
                        if (parseInt(champValeur.value) <= 0) {
                            champValeur.setCustomValidity("Veuillez saisir un nombre positif dans le champ 'Largeur du produit'.");
                            event.preventDefault(); // Empêche l'envoi du formulaire sinon ça vva faire bizzare
                        } else {
                            champValeur.setCustomValidity(""); // Réinitialise la validation personnalisée si la condition est fausse
                        }
                        //reset la validation personnalisée
                        champValeur.addEventListener('input', function () {
                            champValeur.setCustomValidity("");
                        });
                    });
                });
            </script>
        </div>

        <div class="mb-3">
            <label for="refe" class="form-label">Contenance du produit</label>
            <input type="text" class="form-control" name="refe" id="refe" value="<?php echo $value['Contenance'] ?>" required>
            <script>
                // Calcul du volume en litre avec le diml, dimh, dimp
                function calculateVolume() {
                    var diml = parseFloat(document.getElementById('diml').value);
                    var dimh = parseFloat(document.getElementById('dimh').value);
                    var dimp = parseFloat(document.getElementById('dimp').value);

                    // Calculer le volume en litre (1 cm^3 = 0.001 L)
                    var volume = (diml * dimh * dimp) * 0.001;

                    // Afficher le résultat
                    document.getElementById('refe').value = volume;
                }

                // Appeler la fonction lorsqu'une modification est apportée aux dimensions
                document.getElementById('diml').addEventListener('input', calculateVolume);
                document.getElementById('dimh').addEventListener('input', calculateVolume);
                document.getElementById('dimp').addEventListener('input', calculateVolume);
                document.getElementById('refe').addEventListener('input', calculateVolume);
            </script>
        </div>

        <div class="mb-3 form-check mt-3">
            <label for="promo" class="form-check-label">Est-ce que le produit est vendu avec accessoires ?</label>
            <input type="checkbox" class="form-check-input" name="promo" id="promo"><br>
            <script>
                var check = <?php echo $value['Accessoires'] ?>;
                if (check === 1) {
                    document.getElementById('promo').checked = true;
                }
            </script>
        </div>

        <div class="mb-3">
            <label for="poids" class="form-label">Poids du produit</label>
            <input type="text" class="form-control" name="poids" id="poids" value="<?php echo $value['Poids'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="ean" class="form-label">Code barre (13 chiffres)</label>
            <input type="text" class="form-control" name="ean" id="ean" value="<?php echo $value['Codebar'] ?>" required>
        </div>

        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
        <input type="hidden" name="eanv" value="<?php echo $value['CodeBarreValide'] ?>">

        <button class="btn btn-primary" type="submit">Modifier</button>
        <br>
        <br>
        <a class="btn btn-success" href="produit.php">Retour vers la page des produits</a>
    </form>
<?php
}
?>
