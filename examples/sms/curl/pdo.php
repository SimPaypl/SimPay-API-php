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

try {
    $pdo = new PDO('mysql:host=' . $cfg['mysql']['host'] . ';dbname=' . $cfg['mysql']['base'] . ';port=3306', $cfg['mysql']['user'], $cfg['mysql']['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"));
    $pdo->query('SET NAMES utf8mb4');
    $pdo->query('SET CHARACTER SET utf8mb4');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('Connection error.');
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
    $stmt = $pdo->prepare("INSERT INTO `sms` (`service_id`, `number`, `code, `user`) VALUES (:service_id, :number, :code, 'admin');");
    $stmt->bindValue(':service_id', $cfg['service_id'], PDO::PARAM_STR);
    $stmt->bindValue(':number', $cfg['number'], PDO::PARAM_STR);
    $stmt->bindValue(':code', $cfg['code'], PDO::PARAM_STR);
    $stmt->execute();
    
    exit('Podany kod jest prawidłowy!');
} else {
    exit('Podany kod jest nieprawidłowy, lub został już wykorzystany!');
}
