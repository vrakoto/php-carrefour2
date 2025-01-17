<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $css ?>">
</head>

<body>

    <div class="vertical-nav bg-white h-100" id="sidebar">
        <div class="py-4 px-3 bg-light">
            <div class="media d-flex align-items-center">
                <?php if ($role === 'CLIENT') : ?>
                    <i class="fas fa-user fa-3x mr-3 rounded-circle img-thumbnail shadow-sm"></i>
                    <?php else : if ($role === 'ADMIN') : ?>
                        <i class="fas fa-tools fa-3x mr-3 rounded-circle img-thumbnail shadow-sm"></i>
                    <?php else : ?>
                        <i class="fas fa-glasses fa-3x mr-3 rounded-circle img-thumbnail shadow-sm"></i>
                    <?php endif ?>
                <?php endif ?>
                <div class="media-body">
                    <h4 class="m-0 mx-2"><?= $sid ?></h4>
                    <p class="font-weight-light text-muted mb-0 mx-2"><?= $role ?? 'Visiteur' ?></p>
                </div>
            </div>
            <p class="font-weight-light text-muted mb-0 mt-3" id="credit"><?= $credit ?></p>
        </div>

        <!-- <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p> -->

        <ul class="position-relative nav flex-column bg-white mb-0">
            <button class="btn btn-danger text-uppercase mx-3" id="fermerMenu">X</button>

            <div class="mt-4">
                <?= nav_link('fas fa-home', 'accueil', 'Accueil') ?>

                <?php if (!$sid) : ?>
                    <?= nav_link('fas fa-user', 'connexion', 'Se connecter') ?>
                    <?= nav_link('fas fa-user-plus', 'inscription', "S'incrire") ?>
                <?php else : ?>
                    <?php if ($role === 'CLIENT') : ?>
                        <?= nav_link('fas fa-shopping-cart', 'panier', 'Mon panier') ?>
                        <?= nav_link('fas fa-book', 'historiqueAchats', "Mes historiques d'achats") ?>
                        <?= nav_link('fas fa-star-half-alt', 'donnerAvis', "Donner avis produit") ?>
                        <?= nav_link('fas fa-bell', 'notification', "Notification") ?>
                        <?php else : if ($role === 'ADMIN') : ?>
                            <?= nav_link('fas fa-list', 'listeProduits', 'Liste des produits') ?>
                            <?= nav_link('fas fa-list', 'listeCategories', 'Liste des catégories') ?>
                        <?php endif ?>
                    <?php endif ?>
                    <hr class="mb-0 mt-2">
                    <?php if ($role === 'CLIENT') : ?>
                        <?= nav_link('far fa-credit-card', 'credit', 'Ajouter du crédit') ?>
                    <?php endif ?>
                    <?= nav_link('fas fa-sign-out-alt', 'deconnexion', 'Se déconnecter') ?>
                <?php endif ?>
            </div>
        </ul>
        <!-- <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Administration</p> -->
    </div>

    <div class="page-content p-5" id="content">
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold"> Menu</small></button>