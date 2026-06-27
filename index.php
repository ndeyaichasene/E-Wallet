<?php
require_once 'controller.php';

function menu() {
    echo "
        ==== Menu Distributeur ====
        -> 1. Créer Wallet
        -> 2. Faire Dépôt
        -> 3. Faire Retrait
        -> 4. Lister les Transactions
        -> 0. Quitter
        Votre choix : ";
    $choix = trim(fgets(STDIN));
     return $choix;
}

do {
    $choix = menu();
    switch ($choix) {
        case '1':
           creerWalletController();
            break;
        case '2':
          depotController();
            break;
        case '3':
            retraitController();
            break;
        case '4':
            listeTransactionController();
            break;
        case '0':
            afficherMessage("Au revoir !!!\n");
            break;
        default:
            afficherMessage("Choix invalide. Réessayez.\n");
    }
} while ($choix != 0);