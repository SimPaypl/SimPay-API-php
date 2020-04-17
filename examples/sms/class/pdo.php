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

try {
    $pdo = new PDO('mysql:host=' . $cfg['mysql']['host'] . ';dbname=' . $cfg['mysql']['base'] . ';port=3306', $cfg['mysql']['user'], $cfg['mysql']['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"));
    $pdo->query('SET NAMES utf8mb4');
    $pdo->query('SET CHARACTER SET utf8mb4');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('Connection error.');
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
        
        $stmt = $pdo->prepare("INSERT INTO `sms` (`service_id`, `number`, `code, `user`) VALUES (:service_id, :number, :code, 'admin');");
        $stmt->bindValue(':service_id', $cfg['service_id'], PDO::PARAM_STR);
        $stmt->bindValue(':number', $cfg['number'], PDO::PARAM_STR);
        $stmt->bindValue(':code', $cfg['code'], PDO::PARAM_STR);
        $stmt->execute();
        
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
