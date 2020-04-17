<?php
$cfg = array(
    'mysql' => array(
        'host' => 'localhost',
        'user' => 'username',
        'pass' => 'password',
        'base' => 'database'
    ),
    'simpay' => array(
        'auth' => array(
            /*
            *   Klucz API z panelu
            *   Gdzie znaleźć? "simpay > panel > Konto Klienta > API"
            */
            'key' => 'vd4bd866',
            /*
            *   Hasło API z panelu
            *   Gdzie znaleźć? "simpay > panel > Konto Klienta > API"
            */
            'secret' => '1244d231e2dds85d534da3bd4c88efafd'
        ),
        /*
        *   ID Usługi z panelu
        *   Gdzie znaleźć? "simpay > panel > Premium SMS > zarządzaj"
        */
        'service_id' => '0003',
        /*
        *   Numer pod jaki miał zostać wysłany SMS
        */
        'number' => '7055',
        /*
        *   Kod SMS zwrotny, powinien zawierać 6 znaków
        */
        'code' => '58E1Y1'
    )
);

$mysqli = new mysqli($cfg['mysql']['host'], $cfg['mysql']['user'], $cfg['mysql']['pass'], $cfg['mysql']['base']);
if ($mysqli->connect_error) {
    exit('Connection error: ' . $mysqli->connect_error);
}
    
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://simpay.pl/api/status");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array('params' => $cfg['simpay'])));
curl_setopt($curl, CURLOPT_FAILONERROR, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$call = curl_exec($curl);
$response = json_decode($call);
$error = curl_errno($curl);
curl_close($curl);

if ($error) {
    exit('Wystąpił błąd z połączeniem do API');
}
if (!is_object($response)) {
    exit('Wystąpił błąd z API.');
}

if ($response->respond->status == "OK") {
    $stmt = $mysqli->prepare("INSERT INTO `sms` (`service_id`, `number`, `code, `user`) VALUES (?, ?, ?, 'admin');");
    $stmt->bind_param($cfg['service_id'], $cfg['number'], $cfg['code']);
    $stmt->execute();
    
    exit('Podany kod jest prawidłowy!');
} else {
    exit('Podany kod jest nieprawidłowy, lub został już wykorzystany!');
}
