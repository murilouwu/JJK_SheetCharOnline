<?php
    include('Linguege.php');
    class Connect
    {
        public $db;
        public $host;
        public $user;
        public $pass;

        function makeConnection($db, $host, $user, $pass)
        {   
            $dns = "mysql:host=".$host."; dbname=".$db;
            return new PDO($dns, $user, $pass, [
                PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION
            ]);
        }
    }

    try{
        $connect = new Connect();
        $pdo = $connect->makeConnection("jujurpg", "localhost", "root", "");
    } catch(PDOException $e){
        echo $GLOBALS['Tlw'][$_SESSION['Lg']][0].$e->getMessage();
    }
?>