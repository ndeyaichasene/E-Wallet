<?php
require_once 'validator.php';

$wallets = [];
$transactions = [];

function ajouterWallet(array $newWallet) {
    global $wallets;
    $wallets[] = $newWallet;
}

function trouverWalletParTelephone(string $telephone) {
    global $wallets;
    foreach ($wallets as $index => $wallet) {
        if ($wallet['telephone'] == $telephone) {
            return $wallet;
        }
    }
    return null;
}

function mettreAJourSolde(string $telephone,int $montant) {
    global $wallets;
    foreach ($wallets as $index => $wallet) {
        if ($wallet['telephone'] == $telephone) {
            $wallets[$index]['solde'] += $montant;
            return;
        }
    }
}

function ajouterTransaction(array $transaction) {
    global $transactions;
    $transactions[] = $transaction;
}
?>