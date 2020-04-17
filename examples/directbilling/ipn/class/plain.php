<?php
require_once('vendor/autoload.php');

use simpay\Components;
use simpay\Directbilling;

$components = new Components();

$cfg = array(
    'simpay' => array(
        /*
            Klucz API usługi
            Typ pola string
        */
        'apiKey' => 'lNEEDQPfPKHleZdd',
    )
);

$simPay = new Directbilling($cfg['simpay']['apiKey']);

$simPay->setApiKey($cfg['simpay']['apiKey']);

if (!$components->checkIp($components->getRemoteAddr())) {
    $simPay->okTransaction();
    exit();
}

//Parsowanie informacji pobranych z POST
if ($simPay->parse($_POST)) {
    //Sprawdzenie czy parsowanie przebiegło pomyslnie
    if ($simPay->isError()) {
        //Zwrócenie że transakcja została pomyślnie odebrana przez partnera
        $simPay->okTransaction();
        exit();
    }
    
    
    //Sprawdzenie czy transakcja została opłacona
    if (!$simPay->isTransactionPaid()) {
        error_log($simPay->getErrorText());
    }
} else {
    //Sprawdzenie typu błedu
    error_log($simPay->getErrorText());
}

//$simPay->getStatus() - Obecny status transakcji
//$simPay->getValuePartner() - Ile partner rzeczywiście uzyskał prowizji
//$simPay->getControl() - Wartość control wysłana przy starcie transakcji

/*
* Tutaj można wykonywać zapytanie do bazy MySQL ze statusem iż transakcja jest prawidłowa
*/

$simPay->okTransaction();
exit();
