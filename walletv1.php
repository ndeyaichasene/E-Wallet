<?php
//A-Créer wallet
//1.Définition des wallets
// $clients=[0=>'Baila Wane',1=>'Hawa Birane Baila Wane'];
// $telephones=[0=>'771001010',1=>'782345678'];
// $codes=[0=>1234,1=>0000];
// $soldes=[0=>0,1=>100000];

$wallets=[
    0=>['client'=>'Baila Wane','telephone'=>'771001010','code'=>1234,'solde'=>0],
    1=>['client'=>'Hawa Baila Wane','telephone'=>'782345678','code'=>0000,'solde'=>100000]


];
//B-Faire un Depot
$transactions=[
    0=>['montant'=>1000,'indexClient'=>0],
    1=>['montant'=>-5000,'indexClient'=>0]

];
//Fonction metier
function creerWallet(array $newWallet){
         global $wallets;
        //règles métiers 
        //enregistrer wallet
    // array_push($wallets,$newWallet);
    $wallets[]=$newWallet;
    // var_dump($wallets);
    // die;

}
//Fonction d'affichage

function afficherWallet(array $wallets):void{
        // global $wallets;

        for($index=0;$index<count($wallets);$index++){
           echo "Titulaire:". $wallets[$index]['client']."\n";
           echo "Telephone:". $wallets[$index]['telephone']."\n";
        }
        

}

function afficherTransaction(array $transactions ,array $wallets):void{
        
        foreach ($transactions as $index => $transaction) {
            echo "Montant : {$transaction['montant']}\n";
                $indexClient=$transaction['indexClient'];
                $client=$wallets[$indexClient];
            echo "Titulaire : {$client['client']}\n";

        }
}

function saisirWallet():array{
    $wallet=['client'=>'','telephone'=>'','code'=>0,'solde'=>0];
    $wallet['client'] =readline("Veuillez saisir un client :");
    $wallet['telephone'] =readline("Veuillez saisir un telephone :");
    $wallet['code'] = (int)readline("Veuillez saisir un code :");
    $wallet['solde']= (int)readline("veuillez saisir un solde");
    return $wallet ;
}

function saisirTransaction(){
}




$newWallet=saisirWallet();
//validation
creerWallet($newWallet);
afficherWallet($wallets);
afficherTransaction($transactions,$wallets);












?>