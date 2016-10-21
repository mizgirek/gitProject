<?php
header('Content-type: text/plain; charset=windows-1251');
header('Cache-Control: no-store, no-cache');
header('Expires: ' . date('r'));

include_once("./connect.sqlite.php");
$db = ConnectsqliteDost::getInstance();

$sql = "SELECT `id`, `name` FROM `Couriers`";

$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$couriers = $result;

/*$query = mysql_query($sql);
while($array = mysql_fetch_assoc($query)){
    $couriers[] = $array;
}*/

print json_encode($couriers);

?>