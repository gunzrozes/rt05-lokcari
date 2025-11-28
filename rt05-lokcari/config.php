<?php
$DB_HOST='localhost';$DB_NAME='rt05_lokcari';$DB_USER='root';$DB_PASS='';
$pdo=new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",$DB_USER,$DB_PASS,[
 PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
]);
session_start();
function is_logged_in(){return isset($_SESSION['user_id']);}
function current_user(){global $pdo;if(!is_logged_in())return null;
 $s=$pdo->prepare("SELECT * FROM users WHERE id=?");$s->execute([$_SESSION['user_id']]);return $s->fetch();}
?>

// WhatsApp Cloud API placeholders (set these in hosting env)
$WA_PHONE_NUMBER_ID = getenv('WA_PHONE_NUMBER_ID') ?: '';
$WA_TOKEN = getenv('WA_TOKEN') ?: '';
/*
To enable WhatsApp Cloud API:
1. Create a Facebook App and a WhatsApp Business Account
2. Obtain a PHONE_NUMBER_ID and a TOKEN (short-lived or long-lived)
3. Set $WA_PHONE_NUMBER_ID and $WA_TOKEN in config.php (below sample).
*/
