<?php
require_once 'repository.php';
require_once 'validator.php';

function creerWalletService($telephone, $nom, $solde, $codeSecret) {
    if (estVide($telephone)) {
        return "Téléphone obligatoire";
    }
    if (!telephoneValide($telephone)) {
        return "Téléphone invalide (9 chiffres, commençant par 77/70/78/76/75)";
    }
    if (!telephoneUnique($telephone)) {
        return "Ce numéro existe déjà";
    }
    if (estVide($nom)) {
        return "Nom obligatoire";
    }
    if (!nomValide($nom)) {
        return "Nom invalide (lettres uniquement)";
    }
    if (!soldeValide($solde)) {
        return "Solde invalide (nombre positif requis)";
    }
    if (estVide($codeSecret)) {
        return "Code secret obligatoire";
    }
    if (!codeValide($codeSecret)) {
        return "Code invalide (4 chiffres requis)";
    }
    if (!codeUnique($codeSecret)) {
        return "Ce code secret existe déjà";
    }
    $newWallet = [
        'telephone' => $telephone,
        'nom' => $nom,
        'solde' => (int)$solde,
        'codeSecret' => $codeSecret
    ];
    ajouterWallet($newWallet);
    return "Wallet créé avec succès !";
}

function depotService($telephone, $montant) {
    if (!trouverWalletParTelephone($telephone)) {
        return "Ce numéro n'existe pas";
    }
    if (!montantPositif($montant) || $montant == 0) {
        return "Montant invalide";
    }
    mettreAJourSolde($telephone, $montant);
    ajouterTransaction([
        'telephone' => $telephone,
        'montant' => $montant,
        'type' => 'depot'
    ]);
    return "Dépôt de " . $montant . " CFA effectué avec succès !";
}
function calculerFrais($montant) {
    if ($montant <= 10000) {
        return 200;
    } else if ($montant <= 100000) {
        return 500;
    } else {
        $frais = $montant * 0.01;
        if ($frais > 5000) {
            return 5000;
        }
        return $frais;
    }
}
function retraitService($telephone, $montant) {
    if (!trouverWalletParTelephone($telephone)) {
        return "Ce numéro n'existe pas";
    }
    if (!montantPositif($montant) || $montant == 0) {
        return "Montant invalide";
    }
    $frais = calculerFrais($montant);
    $total = $montant + $frais;
    if (!soldeSuffisant($telephone, $total)) {
        return "Solde insuffisant";
    }
    mettreAJourSolde($telephone, -$total);
    ajouterTransaction([
        'telephone' => $telephone,
        'montant' => $montant,
        'frais' => $frais,
        'type' => 'retrait'
    ]);
    return "Retrait de " . $montant . " CFA effectué ! Frais : " . $frais . " CFA";
}

function listeTansactionService() {
    global $transactions;
    if (count($transactions) == 0) {
        return "Aucune transaction";
    }
    $resultat = "";
    foreach ($transactions as $transaction) {
    $resultat .= "Téléphone : " . $transaction['telephone'] . 
                 " | Montant : " . $transaction['montant'] . 
                 " | Type : " . $transaction['type'];
    if ($transaction['type'] == 'retrait') {
        $resultat .= " | Frais : " . $transaction['frais'] . " CFA";
    }
    $resultat .= "\n";
}
    return $resultat;
}


?>