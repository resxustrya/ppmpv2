<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 3/10/2017
 * Time: 9:28 AM
 */



function conn()
{
    
    $server = '192.168.100.17';
    try{
        $pdo = new PDO("mysql:host=$server; dbname=ppmp_v2_2019",'doh7payroll','doh7payroll');
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch (PDOException $err) {
        echo "<h3>Can't connect to database server address $server</h3>";
        exit();
    }
    return $pdo;
}


?>