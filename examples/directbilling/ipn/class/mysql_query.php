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
$mysql = mysql_connect($cfg['mysql']['host'], $cfg['mysql']['username'], $cfg['mysql']['password']);
if (!$mysql) {
    exit('Connection error: ' . mysql_error());
}
$selected = mysql_select_db($cfg['password']['database'], $mysql);
if (!$selected) {
    exit('Connection error: ' . mysql_error());
}

$simPay = new Directbilling($cfg['simpay']['apiKey']);

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
        mysql_close($mysql);
        exit();
    }
    
    //Dodanie informacji o transakcji do bazy danych
    //$simPay->getStatus() - Obecny status transakcji
    //$simPay->getValuePartner() - Ile partner rzeczywiście uzyskał prowizji
    //$simPay->getControl() - Wartość control wysłana przy starcie transakcji
    
    //Sprawdzenie czy transakcja została opłacona
    if ($simPay->isTransactionPaid()) {
        $retval = mysql_query("SELECT * FROM `dcb` WHERE `control` = '" . mysql_real_escape_string($mysql, $simPay->getControl()) . "';", $mysql);

        $detailsUser = mysql_fetch_assoc($retval);

        mysql_free_result($retval);

        if (count($detailsUser) == 0) {
            //Zwrócenie że transakcja została pomyślnie odebrana przez partnera
            $simPay->okTransaction();
            
            mysql_query("UPDATE `dcb` SET `status` = 'completed', `amount` = '" . mysql_real_escape_string($mysql, $simPay->getValuePartner()) . "' WHERE `control` = ''" . mysql_real_escape_string($mysql, $simPay->getControl()) . "';", $mysql);
            mysql_close($mysql);
            
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

mysql_close($mysql);
