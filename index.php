<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INDEXEUUUUU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Ajout d'un produit</h1>
    <form action="bdd/EAN13.php" method="post" id="formulaire">
        <div class="mb-3">
            <label for="marque" class="form-label">Nom du produit (50 caractère max)</label>
            <input type="text" class="form-control" name="marque" id="marque" required>
        </div>

        <div class="mb-3">
            <label for="Descer" class="form-label">Description du produit</label>
            <input type="text" class="form-control" name="Descer" id="Descer" required>
        </div>

        <div class="mb-3">
            <label for="fournisseur" class="form-label">Matière composant le produit</label>
            <input type="text" class="form-control" name="fournisseur" id="fournisseur" required>
        </div>

        <div class="mb-3">
            <label for="diml" class="form-label">Longueur du produit en cm</label>
            <input type="number" class="form-control" step="0.001" name="diml" id="diml" required>
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
            <label for="dimh" class="form-label">Hauteur du produit en cm</label>
            <input type="text" class="form-control" step="0.001" name="dimh" id="dimh" required>
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
            <label for="dimp" class="form-label">Largeur du produit en cm</label>
            <input type="text" class="form-control" step="0.001" name="dimp" id="dimp" required>
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
            <label for="refe" class="form-label">Contenance du produit (entier positif)</label>
            <input type="number" class="form-control" step="0.001" name="refe" id="refe" placeholder="Litre" required>
            <script>
                // Calcul du volume en litre avec le diml, dimh, dimp
                function calculateVolume() {
                    var diml = parseFloat(document.getElementById('diml').value);
                    var dimh = parseFloat(document.getElementById('dimh').value);
                    var dimp = parseFloat(document.getElementById('dimp').value);

                    // Calculer le volume en litre (1 cm^3 = 0.001 L)
                    var volume = (diml * dimh * dimp) * 0.001;

                    // Afficher le résultat
                    document.getElementById('refe').value = volume.toFixed(3); // tofixer(3) pour avoir 3 chiffres après la virgule
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
            <input type="checkbox" class="form-check-input" name="promo" id="promo">
        </div>

        <div class="mb-3">
            <label for="poids" class="form-label">Poids du produit en kg</label>
            <input type="text" class="form-control" name="poids" id="poids" required>
        </div>

        <div class="mb-3">
            <label for="ean" class="form-label">Code barre (13 chiffres)</label>
            <input type="text" class="form-control" name="ean" id="ean" minlength="13" maxlength="13" required>
        </div>

        <input type="submit" value="Envoyer">
    </form>
    <br>
    <a class="btn btn-success" href="produit.php">Voir les produits</a>
    <a class="btn btn-info" href="codebar_checker.php" target="_blank">Vérifier le code barre du produit</a>
    <a class="btn btn-secondary" href="bdd/CodeBarGen.php" target="_blank">Géneré un code barre</a>
</div>
</body>
</html>
