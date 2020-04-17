<?php
require_once('vendor/autoload.php');

use simpay\DirectbillingTransactions;

$cfg = array(
    'simpay' => array(
        /*
            Tryb debugowania
            Typ pola bolean true/false
            Opis Ustawienie pola na TRUE, włączna tryb debugowania, który wyświetla błędy np. w konfiguracji.
        */
        'debugMode' => false,
        /*
            ID usługi
            Typ pola int, np. 60
            Opis ID Usługi DirectCarrierBilling z panelu simpay.pl,
        */
        'serviceId' => 1,
        /*
            Klucz API usługi
            Typ pola string
        */
        'apiKey' => 'lNEEDQPfPKHleZdd',
        /*
            Control
            Typ pola string
        */
        'control' => 112,
        /*
            Adres URL do powrotu po prawidłowej transakcji
            Typ pola string
            Opis Użytkownik jest przekierowywany na ten adres po prawidłowo zakończonej transakcji.
        */
        'completeUrl' => 'https://api.systemy.net/simpay/complete.php',
        /*
            Adres URL do powrotu po nieudanej transakcji
            Typ pola string
            Opis Użytkownik jest przekierowywany na ten adres po nieprawidłowo zakończonej transakcji.
        */
        'failureUrl' => 'https://api.systemy.net/simpay/failure.php',
        /*
            Kwota transakcji
            Typ pola float
        */
        'amount' => 10.00,
        /*
            Typ ustalania prowizji
            Typ pola enum?
            Opis:
                -> Ustawienie opcji amount
                -> Ustawienie opcji amount_gross
                -> Ustawienie opcji amount_required
        */
        'amountType' => 'amount'
    )
);


$simpayTransaction = new DirectbillingTransactions();
$simpayTransaction->setDebugMode($cfg['simpay']['debugMode']);
$simpayTransaction->setServiceID($cfg['simpay']['serviceId']);
$simpayTransaction->setApiKey($cfg['simpay']['apiKey']);
$simpayTransaction->setControl($cfg['simpay']['control']);
$simpayTransaction->setCompleteLink($cfg['simpay']['completeUrl']);
$simpayTransaction->setFailureLink($cfg['simpay']['failureUrl']);
if ($cfg['simpay']['amountType'] == "amount") {
    $simpayTransaction->setAmount($cfg['simpay']['amount']);
} elseif ($cfg['simpay']['amountType'] == "amount_gross") {
    $simpayTransaction->setAmountGross($cfg['simpay']['amount']);
} else {
    $simpayTransaction->setAmountRequired($cfg['simpay']['amount']);
}
$simpayTransaction->generateTransaction();

if ($simpayTransaction->getResults()->status == "success") {
    /*
        Tutaj należy przekierować użytkownika używając np. header('Location: ' . $simpayTransaction->getResults()->link);
        Można dodać tutaj kod, który doda rekord do bazy zapisujący np pole typu control itd.
    */
    echo $simpayTransaction->getResults()->link;
} else {
    echo 'Generowanie transakcji nie powiodło się!';
}
