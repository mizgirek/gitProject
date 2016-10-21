<?php


// Читаем данные, переданные в POST
$rawPost = file_get_contents('php://input');
// Заголовки ответа
header('Content-type: text/plain; charset=windows-1251');
header('Cache-Control: no-store, no-cache');
header('Expires: ' . date('r'));

include_once("./connect.sqlite.php");
$db = ConnectsqliteDost::getInstance();
// Если данные были переданы...
if ($rawPost)
{
    $record = json_decode($rawPost);
    
    $zakaz      = $db->quote($record->zakaz);
    $postCode   = $db->quote($record->postCode); 
    $country    = $db->quote($record->country); 
    $region     = $db->quote($record->region); 
    $sity       = $db->quote($record->sity); 
    $name       = $db->quote($record->name);
    $adres      = $db->quote($record->adres);  
    $phone      = $db->quote($record->phone); 
    $timeDost   = $db->quote($record->timeDost);
    $dateDost   = $db->quote($record->dateDost);
    $courierId  = $db->quote($record->courierId);
    $coasts     = $db->quote($record->coasts);
    $prefix     = $db->quote($record->prefix);
    $timeDostTo = $db->quote($record->timeDostTo);
    $zakazType  = $db->quote($record->zakazType);

    if($zakazType == "Y"){
        $stmt = $db->prepare("INSERT INTO `orders` (`orderId`) VALUES ('".$zakaz."')");
        $stmt->execute();
        $stmt = $db->prepare("INSERT INTO `time` (`order_id`) VALUES ('".$zakaz."')");
        $stmt->execute();
        
        mysql_query("INSERT INTO `orders` (`orderId`) VALUES ('".$zakaz."')");
        mysql_query("INSERT INTO `time` (`order_id`) VALUES ('".$zakaz."')");
    }

    $sql = "UPDATE `orders` 
            SET 
            `postcode` = $postCode
            ,`country` = $country
            ,`region` = $region
            ,`sity` = $sity
            ,`name` = $name
            ,`address` = $adres
            ,`phone` = $phone
            ,`time` = $timeDost
            ,`date` = $dateDost
            ,`courierId` = $courierId
            ,`coast` = $coasts
            WHERE `orderId` = $zakaz                                                                                                          
            ";
        $stmt = $db->prepare($sql);
        
        $stmt->execute();
        if(!$timeDostTo){
            $DostTo = "`time_to` = NULL";
        }else{
            $DostTo = "`time_to` = $timeDostTo";
        }
        $updateTime = "UPDATE `time`
                       SET
                        `time_from` = $timeDost
                       ,$DostTo
                       ,`prefix` = $prefix
                       WHERE `order_id` = $zakaz
                       ";
        $stmt = $db->prepare($updateTime);
        $stmt->execute();
     
    print json_encode(
        array
		(
			'result' => 'OK'
		)
     );   
}
else{
    print json_encode(
        array
		(
			'result' => 'NO'
		)
    );
    
}


?>