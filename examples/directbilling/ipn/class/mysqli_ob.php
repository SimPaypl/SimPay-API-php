<?php
require_once('vendor/autoload.php');

use simpay\Components;
use simpay\Directbilling;

$components = new Components();

$cfg = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'username',
        'password' => 'password',
        'database' => 'database'
    ),
    'simpay' => array(
        /*
            Klucz API usługi
            Typ pola string
        */
        'apiKey' => '3c7f4b55',
    )
);

//Laczenie do bazy danych
$mysqli = new mysqli($cfg['mysql']['host'], $cfg['mysql']['username'], $cfg['mysql']['password'], $cfg['password']['database']);
if ($mysqli->connect_error) {
    exit('Connection error: ' . $mysqli->connect_error);
}

$simPay = new Directbilling($cfg['simpay']['apiKey']);

$simPay->setApiKey($cfg['simpay']['apiKey']);

if (!$components->checkIp($components->getRemoteAddr())) {
    $simPay->okTransaction();
    exit();
}

//Parsowanie informacji pobranych z POST
if ($simPay->parse($_POST)) {
    //if ($simPay->)
    
    //Sprawdzenie czy parsowanie przebiegło pomyslnie
    if ($simPay->isError()) {
        //Zwrócenie że transakcja została pomyślnie odebrana przez partnera
        $simPay->okTransaction();
        $mysqli->close();
        exit();
    }
    
    //Dodanie informacji o transakcji do bazy danych
    //$simPay->getStatus() - Obecny status transakcji
    //$simPay->getValuePartner() - Ile partner rzeczywiście uzyskał prowizji
    //$simPay->getControl() - Wartość control wysłana przy starcie transakcji
    
    //Sprawdzenie czy transakcja została opłacona
    if ($simPay->isTransactionPaid()) {
        $stmt = $mysqli->prepare("SELECT * FROM `dcb` WHERE `control` = ?;");
    
        $stmt->bind_param($simPay->getControl());
        $stmt->execute();

        $detailsUser = $stmt->fetch();

        if (count($detailsUser) == 0) {
            //Zwrócenie że transakcja została pomyślnie odebrana przez partnera
            $simPay->okTransaction();

            $stmt = $mysqli->prepare("UPDATE `dcb` SET `status` = 'completed', `amount` = ? WHERE `control` = ?;");
            $stmt->bind_param($simPay->getValuePartner(), $simPay->getControl());
            $stmt->execute();
            $mysqli->close();
            
            exit();
        }
    }
} else {
    //Sprawdzenie typu błedu
    error_log($simPay->getErrorText());
}

//Zwrócenie że transakcja została pomyślnie odebrana przez partnera
//Wartość zwracana przez partnera powinna zawierać tylko "OK". System SimPay uzna wtedy, że transakcja została poprawnie obsłużona i nie będzie ponawiał zapytań do serwisu partnera.
$simPay->okTransaction();

$mysqli->close();
