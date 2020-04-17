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

$pdo = null;

//Laczenie do bazy danych
try {
    $pdo = new PDO('mysql:host=' . $cfg['mysql']['host'] . ';dbname=' . $cfg['mysql']['database'] . ';port=3306', $cfg['mysql']['username'], $cfg['mysql']['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"));
    $pdo->query('SET NAMES utf8mb4');
    $pdo->query('SET CHARACTER SET utf8mb4');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('Conection error.');
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
        $simPay->okTransaction();
        exit();
    }
    
    //Dodanie informacji o transakcji do bazy danych
    //$simPay -> getStatus() - Obecny status transakcji
    //$simPay -> getValuePartner() - Ile partner rzeczywiście uzyskał prowizji
    //$simPay -> getControl() - Wartość control wysłana przy starcie transakcji
    
    //Sprawdzenie czy transakcja została opłacona
    if ($simPay->isTransactionPaid()) {
        $stmt = $pdo->prepare('SELECT * FROM `dcb` WHERE `control` = :control');
    
        $stmt->bindValue(':control', $simPay->getControl(), PDO::PARAM_INT);

        $stmt->execute();

        $detailsUser = $stmt->fetchAll();

        if (count($detailsUser) == 0) {
            //Zwrócenie że transakcja została pomyślnie odebrana przez partnera
            $simPay -> okTransaction();
            
            $stmt = $pdoObject->prepare("UPDATE `dcb` SET `status` = 'completed', `amount` = :amount WHERE `control` = :control;");
            $stmt->bindValue(':control', $simPay->getControl(), PDO::PARAM_INT);
            $stmt->bindValue(':amount', $simPay->getValuePartner(), PDO::PARAM_STR);
            $stmt->execute();

            exit();
        }

        //$simPay -> getValuePartner() - Ile partner rzeczywiście uzyskał prowizji
    }
} else {
    //Sprawdzenie typu błedu
    error_log($simPay->getErrorText());
}

//Zwrócenie że transakcja została pomyślnie odebrana przez partnera
//Wartość zwracana przez partnera powinna zawierać tylko "OK". System SimPay uzna wtedy, że transakcja została poprawnie obsłużona i nie będzie ponawiał zapytań do serwisu partnera.
$simPay->okTransaction();
