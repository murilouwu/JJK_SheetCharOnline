<?php
    include('PhpMain.php');
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $respost = [];
    
        $UserAction = new BankUse();
        $UserAction->NameTable = 'host';
        $UserAction->Dates = array('nameGame', 'nameMaster', 'pass', 'stDono', 'idCod', 'img');
    
        $searchTerm = $_POST['code'];
        $result = $UserAction->SearchTable($pdo, 'idCod', $searchTerm);
    
        if (is_array($result)) {
            if (count($result) === 1) {
                $respost['data'] = $result[0];
            } else {
                $respost['message'] = "nop";
            }
        } else {
            $respost['message'] = $result;
        }
    
        echo json_encode($respost);
    }else {
        echo json_encode(["message" => $GLOBALS['Tlw'][$_SESSION['Lg']][17]]);
    }
?>
