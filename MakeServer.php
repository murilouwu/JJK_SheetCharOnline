<?php
    include('assets/php/PhpMain.php');
    header('Content-Type: application/json');
    
    function random($Codes){
        do {
            $html = new HtmlBased();
            $random = $html->CodLink(6);
        } while (in_array($random, $Codes));
        return $random;
    };

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $html = new HtmlBased();
        $Codes = array();

        $UserAction = new BankUse();
        $UserAction->NameTable = 'host';
        $UserAction->Dates = array('nameGame', 'nameMaster', 'pass', 'stDono', 'idCod', 'img');
        
        $UserFun = $UserAction->GetTable($pdo, $date[3], "");

        if(is_string($UserFun)){}else{
            $a = 0;
            foreach($UserFun as $row){
                $Codes[$a] = $row;
                $a++;
            }
        }

        $uniqueCode = random($Codes);

        //img
        $FolderFile = 'ImgHost/';
        $lp = true;
        $a = 1;
        while($lp == true){
            if(!file_exists($FolderFile)){
                mkdir(__DIR__.'/'.$FolderFile, 0777, true);
                $lp = false;
            }else{
                $FolderFile = $FolderFile.'('.$a.')';
                $a++;
                continue;
            }
        };

        $fileExtension = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION);
        $NameFile = $_POST['Title'].$uniqueCode.'.'.$fileExtension;

        $res = $html->upload($_FILES['Image'], $FolderFile, $NameFile);
 
        $VlCad = array($_POST['Title'], $_POST['NameInput'], $html->Cripto($_POST['SenhaInput']), $uniqueCode, ($FolderFile.'/'.$NameFile));
        $Verifcs = array(3);
        $Configs = array();
        
        $UserFun = $UserAction->InsertTable($pdo, $VlCad, $Verifcs, $Configs);
        
        $respost = [
            "Mensagem" => $UserFun,
            "code" => $uniqueCode,
        ];
        
        echo json_encode($respost);
    } else {
        echo json_encode(["message" => $GLOBALS['Tlw'][$_SESSION['Lg']][17]]);
    }
?>
