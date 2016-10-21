<?php
header('Content-type: text/plain; charset=windows-1251');
header('Cache-Control: no-store, no-cache');
header('Expires: ' . date('r'));

include_once("./connect.sqlite.php");
$db = ConnectsqliteDost::getInstance();

$orderId = htmlspecialchars(stripcslashes((int)$_GET["order"]));

if($orderId){
    $sql = "DELETE FROM `orders` WHERE `orderId` = $orderId";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    print json_encode(array('result' => 'Возврат'));
}
else{
    print json_encode(array('result' => 'Возврат'));
}

?>