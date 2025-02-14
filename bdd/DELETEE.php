<?php
#$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
include '../config.php';
$servername = config::SERVEUR;
$username = config::UTILISATEUR;
$password = config::MOTDEPASSE;
$dbname = config::BASEDEDONNEES;

# Crée une connexion avec la base de données
$conn = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES
    , Config::UTILISATEUR, Config::MOTDEPASSE);
$delte = $conn->prepare("DELETE FROM produit WHERE id = :id");
$delte->bindParam(':id', $id);
#$delte->execute();
header("Location:../produit.php");

#PS Je verrais un autre jour si j'ai la putain de foi à faire sa en 1 seul fichier sans que php me les brise a pas faire passer une execution sql dans un IF BORDEL