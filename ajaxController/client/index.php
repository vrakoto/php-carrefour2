<?php
define("CLIENT_MODEL", BDD . 'client' . DIRECTORY_SEPARATOR);
require_once CLIENT_MODEL . 'Client.php';
$client = new Client;

switch ($action) {
    case 'notifierProduit':
        $erreur = '';
        $idProduit = (int)$_POST['idProduit'];
        try {
            $client->notifierProduit($idProduit);
        } catch (\Throwable $th) {
            $erreur = "Erreur général notification";
        }
        echo $erreur;
    break;

    case 'retirerNotification':
        $erreur = '';
        $idProduit = (int)$_POST['idProduit'];
        try {
            $client->retirerNotification($idProduit);
        } catch (\Throwable $th) {
            $erreur = "Erreur général notification";
        }
        echo $erreur;
    break;

    case 'ajouterProduitPanier':
        $erreur = '';
        $idProduit = (int)$_POST['idProduit'];
        $quantite = (int)$_POST['quantite'];

        if ($quantite <= 0) {
            $erreur = "La quantité ne doit pas être inférieur ou égale à 0";
        }

        if ($quantite > $pdo->getLeProduit($idProduit)['quantite']) {
            $erreur = "La quantité demandée est supérieure à l'offre";
        }

        if (empty($erreur)) {
            try {
                $idPanier = $client->getMonPanier()['id'];
                $client->ajouterProduitPanier($idPanier, $idProduit, $quantite);
            } catch (\Throwable $th) {
                $erreur = "Erreur interne lors de l'ajout du produit dans le panier";
            }
        }
        echo $erreur;
    break;

    case 'updateQuantite':
        $erreur = '';
        $idProduit = (int)$_POST['idProduit'];
        $prixUnit = (float)$_POST['prixUnit'];
        $quantiteUtilisateur = (int)$_POST['quantite'];
        $leProduit = $pdo->getLeProduit($idProduit); // produit provenant de la BDD

        if ($prixUnit !== (float)$leProduit['prixUnit']) {
            $erreur = "Le prix unitaire du produit est incorrect";
        }

        if ($quantiteUtilisateur <= 0) {
            $erreur = "La quantité est inférieur ou égale à 0";
        }

        if ($quantiteUtilisateur > (int)$leProduit['quantite']) {
            $erreur = "La quantité est supérieur à l'offre";
        }

        if (empty($erreur)) {
            try {
                $client->updateMaQuantite($idProduit, $quantiteUtilisateur);
            } catch (\Throwable $th) {
                $erreur = "Erreur rencontrée lors de la mise à jour de la quantité";
            }
        }
        echo $erreur;
    break;

    case 'supprimerProduitPanier':
        $erreur = '';
        $idProduit = (int)$_POST['idProduit'];
        try {
            $client->supprimerProduitPanier($idProduit);
        } catch (\Throwable $th) {
            $erreur = "Erreur lors de la suppresion du produit dans votre panier";
        }
        echo $erreur;
    break;

    case 'updateTotal':
        $idPanier = (int)$client->getMonPanier()['id'];
        $lesProduits = (array)$client->getLesProduitsPanier();

        (float)$sums = [];
        foreach ($lesProduits as $produit) {
            $idProduit = (int)$produit['idProduit'];
            $quantite = (int)$produit['quantite'];
            $prixUnit = $pdo->getLeProduit($idProduit)['prixUnit'];
            $sums[] = ($prixUnit*$quantite);
        }
        echo array_sum($sums);
    break;

    case 'envoyerAvis':
        $erreur = '';
        $idProduit = (int)$_POST['idProduit'];
        $commentaire = htmlentities($_POST['commentaire']);
        $note = (int)$_POST['note'];

        if (empty($pdo->getLeProduit($idProduit)['id'])) {
            $erreur = "Produit inexistant";
        }

        if ($note <= 0 || $note > 5) {
            $erreur = "La note ne doit pas être inférieur ou égal à 0 ni supérieur à 5";
        }

        if (empty($erreur)) {
            try {
                $client->envoyerAvis($idProduit, $commentaire, $note);
            } catch (\Throwable $th) {
                $erreur = "Erreur général";
            }
        }
        echo $erreur;
    break;
}