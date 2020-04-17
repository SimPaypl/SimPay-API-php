<?php

$cfg = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => '3306',
        'password' => 'password',
        'database' => 'database'
    ),
    'simpay' => array(
        /*
            Tryb debugowania
            Typ pola bolean true/false
            Opis Ustawienie pola na TRUE, włączna tryb debugowania, który wyświetla błędy np. w konfiguracji.
        */
        'debugMode' => true,
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
            Opis
                -> Ustawienie opcji amount
                -> Ustawienie opcji amount_gross
                -> Ustawienie opcji amount_required
        */
        'amountType' => 'amount'
    )
);


$mysqli = new mysqli($cfg['mysql']['host'], $cfg['mysql']['username'], $cfg['mysql']['password'], $cfg['mysql']['database']);
if ($mysqli->connect_error) {
    exit('Connection error: ' . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("INSERT INTO `dcb` (`control`, `price`, `status`) VALUES (?, ?, ?);");
$stmt->bind_param($cfg['simpay']['control'], $cfg['simpay']['price'], 'new');
$stmt->execute();

$array = array(
    'serviceId' => $cfg['simpay']['serviceId'],
    'control' => $cfg['simpay']['control'],
    'complete' => $cfg['simpay']['completeUrl'],
    'failure' => $cfg['simpay']['failureUrl'],
    'sign' => hash('sha256', $cfg['simpay']['serviceId'] . $cfg['simpay']['amount'] . $cfg['simpay']['control'] . $cfg['simpay']['apiKey'])
);

if ($cfg['simpay']['amountType'] == "amount") {
    $array['amount'] = $cfg['simpay']['amount'];
} elseif ($cfg['simpay']['amountType'] == "amount_gross") {
    $array['amount_gross'] = $cfg['simpay']['amount'];
} else {
    $array['amount_required'] = $cfg['simpay']['amount'];
}


$ch = curl_init('https://simpay.pl/db/api');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result);

if ($result->status == "success") {
    header('Location: ' . $result->link);
    exit();
} else {
    echo 'Wystąpił błąd podczas generowania transakcji.';
    if ($cfg['simpay']['debugMode']) {
        echo '<br/>Debug --> ';
        print_r($result);
    }
}
