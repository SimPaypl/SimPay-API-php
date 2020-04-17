<?php
require_once('vendor/autoload.php');

use simpay\Sms;

$cfg = array(
    'mysql' => array(
        'host' => 'localhost',
        'user' => 'username',
        'pass' => 'password',
        'base' => 'database',
    ),
    'simpay' => array(
        'debug' => false,
        /*
        *   Klucz API z panelu
        *   Gdzie znaleźć? "simpay > panel > Konto Klienta > API"
        */
        'apiKey' => '3c7f4b55',
        /*
        *   Hasło API z panelu
        *   Gdzie znaleźć? "simpay > panel > Konto Klienta > API"
        */
        'apiSecret' => '1663121e0b37857519383b8f088efafb',
        /*
        *   ID Usługi z panelu
        *   Gdzie znaleźć? "simpay > panel > Premium SMS > zarządzaj"
        */
        'serviceId' => 3403,
        /*
        *   Numer pod jaki miał zostać wysłany SMS
        */
        'number' => 7055,
        /*
        *   Kod SMS zwrotny, powinien zawierać 6 znaków
        */
        'code' => 'D4799A'
    )
);

$mysqli = mysqli_connect($cfg['mysql']['host'], $cfg['mysql']['user'], $cfg['mysql']['pass'], $cfg['password']['base']);
if (!$mysqli) {
    exit('Connection error: ' . mysqli_connect_error());
}

try {
    $api = new Sms($cfg['simpay']['apiKey'], $cfg['simpay']['apiSecret']);
    $api->getStatus(array('service_id' => $cfg['simpay']['serviceId'], 'number' => $cfg['simpay']['number'], 'code' => $cfg['simpay']['code']));
    
    if ($api->check()) {
        /*
        *   Tutaj kod jest prawidłowy.
        *
        *   $api->getRespondValue() -> Kwota dla partnera z danej transakcji, przydatne przy np. obliczaniu zarobków w zewnętrznym panelu.
        */
        
        $stmt = mysqli_prepare($mysqli, "INSERT INTO `sms` (`service_id`, `number`, `code, `user`) VALUES (?, ?, ?, 'admin');");
        mysqli_stmt_bind_param($stmt, $cfg['service_id'], $cfg['number'], $cfg['code']);
        mysqli_stmt_execute($stmt);
        
        echo 'Wprowadzono poprawny kod.';
    } elseif ($api->error() && $cfg['simpay']['debug']) {
        echo 'Wystapil blad:<br/>';
        echo $api->pre($api->showError());
    } else {
        echo 'Wprowadzono nieprawidłowy kod.';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
