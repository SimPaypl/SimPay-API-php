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
        'apiKey' => 'lNEEDQPfPKHleZdd',
    )
);

//Laczenie do bazy danych
$mysqli = mysqli_connect($cfg['mysql']['host'], $cfg['mysql']['username'], $cfg['mysql']['password'], $cfg['password']['database']);
if (!$mysqli) {
    exit('Connection error: ' . mysqli_connect_error());
}

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

        mysqli_stmt_close($mysqli);

        exit();
    }
    
    //Dodanie informacji o transakcji do bazy danych
    //$simPay->getStatus() - Obecny status transakcji
    //$simPay->getValuePartner() - Ile partner rzeczywiście uzyskał prowizji
    //$simPay->getControl() - Wartość control wysłana przy starcie transakcji
    
    //Sprawdzenie czy transakcja została opłacona
    if ($simPay->isTransactionPaid()) {
        $stmt = mysqli_prepare($mysqli, "SELECT * FROM `dcb` WHERE `control` = ?;");
    
        mysqli_stmt_bind_param($stmt, $simPay->getControl());
        mysqli_stmt_execute($stmt);
        $detailsUser = mysqli_stmt_fetch($stmt);

        if (count($detailsUser) == 0) {
            //Zwrócenie że transakcja została pomyślnie odebrana przez partnera
            $simPay->okTransaction();
            
            $stmt = mysqli_prepare($mysqli, "UPDATE `dcb` SET `status` = 'completed', `amount` = ? WHERE `control` = ?;");
            mysqli_stmt_bind_param($stmt, $simPay->getValuePartner(), $simPay->getControl());
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($mysqli);

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

mysqli_stmt_close($conn);
