<?php
header('Content-type: text/plain; charset=windows-1251');
header('Cache-Control: no-store, no-cache');
header('Expires: ' . date('r'));

include_once("./connect.sqlite.php");
$db = ConnectsqliteDost::getInstance();

$zakaz = (int)$_GET["zakaz"] * 1;
if($zakaz && $zakaz > 0 && $zakaz < 1000000){
    
    //$querySelect = "SELECT `orderId`,`postcode`,`country`,`region`,`sity`,`name`,`address`,`phone`,`time`,`date`,`courierId`,`coast` FROM orders WHERE orderId = '$zakaz'";
    $querySelect = "
        SELECT
            `orders`.`orderId`
            ,`orders`.`postcode`
            ,`orders`.`country`
            ,`orders`.`region`
            ,`orders`.`sity`
            ,`orders`.`name`
            ,`orders`.`address`
            ,`orders`.`phone`
            ,`orders`.`time`
            ,`orders`.`date`
            ,`orders`.`coast`
            ,`Couriers`.`name` AS `courier`
            ,`Couriers`.`id` AS `courierID`
			,`time`.`time_from` AS `time_from`
			,`time`.`time_to` AS `time_to`
			,`time`.`prefix` AS `prefix`
        FROM orders
        LEFT OUTER JOIN Couriers ON  `orders`.`courierId` =  `Couriers`.`id`
		LEFT OUTER JOIN `time` ON  `orders`.`orderId` =  `time`.`order_id`
		WHERE  `orders`.`orderId` =  '$zakaz'
		ORDER BY `orders`.`time` ASC
    ";
    /*
    $mysqlQuery = mysql_query($querySelect);
    $mysqlArray = mysql_fetch_assoc($mysqlQuery);
    */
    $stmt = $db->prepare($querySelect);
    $stmt->execute();
    $mysqlArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //print_r($mysqlArray);
    if(!$mysqlArray[0]['orderId']){
        
        include '../pdoConn.class.php';
        $dbmssql = pdoConn::getInstance();

        $sql = "SELECT date, user_info FROM catalog_orders WHERE id = $zakaz";
        $stmt = $dbmssql->prepare($sql);
        $stmt->execute();
        $infoZakaz = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($infoZakaz);
        if(!count($infoZakaz)){
            print "Такого заказа нету!!!!!!!!";
            exit();
        }
        
        /*$query = mssql_query($sql) or die ("Такого заказа нету!");
        $array = mssql_fetch_array($query);
*/  
        //print $infoZakaz[0]["user_info"];
        //$infoZakaz[0]["user_info"] = iconv("windows-1251", "UTF-8", $infoZakaz[0]["user_info"]);
        //$infoZakaz[0]["user_info"] = iconv("UTF-8","windows-1251",  $infoZakaz[0]["user_info"]);
        //print $mystr;
        
        $order   = array("почтовый индекс:", "страна:", "регион:", "город:", "Ф.И.О. получателя:", "адрес для доставки:", "телефон:","e-mail:","комментарий:","способ доставки:","способ оплаты:","открытка:","упаковка:");
        $replace = '|';
        $newstr = str_replace($order, $replace, $infoZakaz[0]["user_info"]);
        $OP = (explode('|',$newstr));
        if(count($OP) > 1){

            $orderInfo["orderId"] = trim(iconv("windows-1251","UTF-8",$zakaz));
            $orderInfo["postcode"] = trim(iconv("windows-1251","UTF-8",$OP[1]));
            $orderInfo["country"] = trim(iconv("windows-1251","UTF-8",$OP[2]));
            $orderInfo["region"] = trim(iconv("windows-1251","UTF-8",$OP[3]));
            $orderInfo["sity"] = trim(iconv("windows-1251","UTF-8",$OP[4]));
            $orderInfo["name"] = trim(iconv("windows-1251","UTF-8",$OP[5]));
            $orderInfo["address"] = trim(iconv("windows-1251","UTF-8",$OP[6]));
            $orderInfo["phone"] = trim(iconv("windows-1251","UTF-8",$OP[7]));
            $orderInfo["time"] = date("H:i:s");
            $orderInfo["date"] = date("Y-m-d");
                
                
                
            $queryInsert = "INSERT INTO `orders` 
                                ( `orderId` ,`postcode` ,`country` ,`region` ,`sity`   ,`name`   ,`address` ,`phone`) 
                         VALUES (  '".$orderInfo["orderId"]."'
                                  ,'".$orderInfo["postcode"]."'
                                  ,'".$orderInfo["country"]."'
                                  ,'".$orderInfo["region"]."'
                                  ,'".$orderInfo["sity"]."'
                                  ,'".$orderInfo["name"]."'
                                  ,'".$orderInfo["address"]."'
                                  ,'".$orderInfo["phone"]."'
                                 )";
            
            //mysql_query($queryInsert);
            $stmt = $db->prepare($queryInsert);
            $stmt->execute();
            
            $insertTime = "INSERT INTO `time` (`order_id`) VALUES ('".$orderInfo["orderId"]."')";
            $stmt = $db->prepare($insertTime);
            $stmt->execute();
            
            //mysql_query($insertTime);
            
            
            print json_encode($orderInfo);
            
        }
        else{
            print json_encode(array('result'=>'Такого заказа нету'));
        }
    }
    else{
        print json_encode($mysqlArray[0]);
        
    }
}
    
?>

