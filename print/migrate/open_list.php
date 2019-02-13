<?php

include_once 'array_open_list.php';

$server = 'localhost';

    try{
        $pdo = new PDO("mysql:host=$server; dbname=ppmp_v2",'root','');
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch (PDOException $err) {
        echo "<h3>Can't connect to database server address $server</h3>";
        exit();
    }

$query = "INSERT IGNORE INTO open_list(code,ppcode,item,unit,q1_qty,q1_amt,created_by,date_added,added_by,division) VALUES";
foreach($open_list as $list)
{
    $list['code'] = $list['code'] ? $list['code'] : 0;
    $list['ppcode'] = $list['ppcode'] ? $list['ppcode'] : 0;
    $list['item'] = $list['item'] ? $list['item'] : null;
    $list['unit'] = $list['unit'] ? $list['unit'] : 'pc';
    $list['quantity'] = $list['quantity'] ? $list['quantity'] : 0;
    $list['amount'] = $list['amount'] ? $list['amount'] : 0.00;
    $list['created_by'] = $list['created_by'] ? $list['created_by'] : 0;
    $list['date_added'] = $list['date_added'] ? $list['date_added'] : 0;
    $list['added_by'] = $list['added_by'] ? $list['added_by'] : 0;
    $list['division'] = $list['division'] ? $list['division'] : 0;

    $query.= "('" . $list['code'] . "','" . $list['ppcode'] . "','" . addslashes($list['item']) ."','".$list['unit']."','" . $list['quantity'] . "','" . $list['amount'] . "','".$list['created_by']."','" .$list['date_added']. "','".$list['added_by'] ."','" . $list['division']."'),";
}

$query.= "('','','','','','','','','','')";


$st = $pdo->prepare($query);
$st->execute();
echo "ok";

?>