<?php

require_once 'services.php';

function afficherMessage(string $message) {
    echo $message . "\n";
}

function saisirWallet() {
    return trim(fgets(STDIN));
}

function creerWalletController() {
    afficherMessage("Numéro de téléphone : ");
    $telephone = saisirWallet();

    afficherMessage("Nom du client : ");
    $nom = saisirWallet();

    afficherMessage("Solde initial : ");
    $solde = saisirWallet();

    afficherMessage("Code secret : ");
    $codeSecret = saisirWallet();

    $resultat = creerWalletService($telephone, $nom, $solde, $codeSecret);
    afficherMessage($resultat);
}

function depotController() {

    afficherMessage("Téléphone : ");
    $telephone = saisirWallet();

    afficherMessage("Montant : ");
    $montant = saisirWallet();

    $resultat = depotService($telephone, $montant);
    afficherMessage($resultat);
}

function retraitController() {
    afficherMessage("Téléphone : ");
    $telephone = saisirWallet();

    afficherMessage("Montant : ");
    $montant = saisirWallet();
    
    $resultat = retraitService($telephone, $montant);
    afficherMessage($resultat);
}

function listeTransactionController() {
    $resultat = listeTansactionService();
    afficherMessage($resultat);
}


?>