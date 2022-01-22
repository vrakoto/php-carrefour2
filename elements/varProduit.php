<?php
$leProduit = $pdo->getLeProduit($id);
$imagePrincipale = htmlentities($leProduit['image']);
$idCategorie = (int)$leProduit['idCategorie'];
$categorie = $pdo->getLaCategorie($idCategorie);
$ref = htmlentities($leProduit['ref']);
$quantite = (int)$leProduit['quantite'];
$produitDisponible = ($quantite > 0);
$opacity = "";
$prixUnit = (float)$leProduit['prixUnit'];
$description = htmlentities($leProduit['description']);