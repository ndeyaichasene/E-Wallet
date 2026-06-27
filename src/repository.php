<?php

namespace Wallet\Repository;


$wallets = [];
$transactions = [];

function ajouterWallet(array $newWallet) {
    global $wallets;
    $wallets[] = $newWallet;
}

function trouverWalletParTelephone(string $telephone) {
    global $wallets;
    $resultat = array_filter(($wallets),function ($wallet) use ($telephone) {
        return ($wallet['telephone'] == $telephone);
    });
    return array_shift($resultat) ?? null;
}
function trouverWalletParCode(string $code) {
    global $wallets;
    $resultat = array_filter($wallets, function($wallet) use ($code) {
        return $wallet['codeSecret'] == $code;
    });
    return array_shift($resultat) ?? null;
}


function mettreAJourSolde(string $telephone,int $montant) {
    global $wallets;
    $wallets = array_map(function ($wallet) use ($telephone, $montant) {
     if ($wallet['telephone'] == $telephone) {
            $wallet['solde'] += $montant;
            
        }
        return $wallet;
},$wallets);
}


function ajouterTransaction(array $transaction) {
    global $transactions;
    $transactions[] = $transaction;
}
?>