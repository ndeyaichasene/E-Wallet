<?php

namespace Wallet\Validator;
use function Wallet\Repository\trouverWalletParTelephone;
use function Wallet\Repository\trouverWalletParCode;

function estVide($valeur) {
    if ($valeur == '') {
        return true;
    }
    return false;
}
function nomValide(string $nom) {
    for ($i = 0; $i < strlen($nom); $i++) {
        if (is_numeric($nom[$i])) {
            return false;
        }
    }
    return true;
}
function montantPositif(int $montant) {
    if ($montant >= 0) {
        return true;
    }
    return false;
}

function telephoneUnique(string $telephone) {
    $wallet = trouverWalletParTelephone($telephone);
    if ($wallet == null) {
        return true;
    }
    return false;
}



function soldeSuffisant(string $telephone,int $montant) {
    $wallet = trouverWalletParTelephone($telephone);
    if ($wallet['solde'] >= $montant) {
        return true;
    }
    return false;
}
function soldeValide(int $solde) {
    if (!is_numeric($solde)) {
        return false;
    }
    if ((int)$solde < 0) {
        return false;
    }
    return true;
}

function telephoneValide(string $telephone) {
    if (strlen($telephone) != 9) {
        return false;
    }
    $prefixes = ['77', '70', '78', '76', '75'];
    $debut = substr($telephone, 0, 2);
    $valide = false;
    foreach ($prefixes as $prefix) {
        if ($debut == $prefix) {
            $valide = true;
        }
    }
    if (!$valide) {
        return false;
    }
    for ($i = 0; $i < strlen($telephone); $i++) {
        if (!is_numeric($telephone[$i])) {
            return false;
        }
    }
    return true;
}
function codeValide(string $code) {
    if (strlen($code) != 4) {
        return false;
    }
    for ($i = 0; $i < strlen($code); $i++) {
        if (!is_numeric($code[$i])) {
            return false;
        }
    }
    return true;
}

function codeUnique(string $code) {
    $wallet = trouverWalletParCode($code);
    if ($wallet == null) {
        return true;
    }
    return false;
}

?>