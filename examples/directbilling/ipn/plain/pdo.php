<?php
$cfg = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'username',
        'password' => 'password',
        'database' => 'database'
    ),
    /*
    * Klucz API z panelu
    */
    'apiKey' => 'yjhy45ffgbxv',
    /*
    * ID Usługi z panelu simpay
    */
    'serviceId' => 1111,
    /*
    * Kwota jaką miała kosztować usługa
    */
    'amount' => 22.50
);

function getRemoteAddr()
{
    return getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR'[0]) ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
}

function checkIp($ip)
{
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://simpay.pl/api/get_ip');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = json_decode(curl_exec($curl));
    curl_close($curl);

    return in_array($ip, $response->respond->ips);
}

if (!checkIp(getRemoteAddr())) {
    exit('OK');
}

if (!isset($_POST['id'], $_POST['status'], $_POST['valuenet_gross'], $_POST['valuenet'], $_POST['valuepartner'], $_POST['control'], $_POST['sign'])) {
    exit('OK');
}

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

$json = json_encode($_POST);

/*

* ID Trsanakcji
$json->id;

* Status transakcji
$json->status;

* Kwota transakcji brutto
$json->valuenet_gross;

* Kwota transakcji netto
$json->valuenet;

* Kwota z tranakcji jaką otrzymał partner
$json->valuepartner;

* Pole do wykorzystania przez parnera, np do przechowywania informacji o płatności
$json->control;

* Pole, które pozwala zweryfikować poprawność transakcji, a także pochodzenie notyfikacji
$json->sign;

*/

if ($json->status != "ORDER_PAYED") {
    exit('OK');
}

if ($json->sign != hash('sha256', $json->id . $json->status . $json->valuenet . $json->valuepartner . $json->control . $cfg['apiKey'])) {
    exit('OK');
}

if ($json->valuenet_gross != $cfg['amount']) {
    exit('OK');
}

$stmt = $pdo->prepare('SELECT * FROM `dcb` WHERE `control` = :control AND `status` = new;');
$stmt->bindValue(':control', $simPay->getControl(), PDO::PARAM_INT);
$stmt->execute();
$detailsUser = $stmt->fetchAll();

if (count($detailsUser) == 0) {
    /*
    * Setowanie statusu transakcji jako completed w przypadku poprawnego zakończenia transakcji i jeżeli dana transakcja po polu control została znaleziona w bazie danych
    */
    $stmt = $pdoObject->prepare("UPDATE `dcb` SET `status` = 'completed', `amount` = :amount WHERE `control` = :control;");
    $stmt->bindValue(':control', $json->control, PDO::PARAM_INT);
    $stmt->bindValue(':amount', $json->valuepartner, PDO::PARAM_STR);
    $stmt->execute();
}

ob_clean();
exit('OK');
