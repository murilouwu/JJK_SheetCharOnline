<?php
	include('Config.php');
    
	final class HtmlBased
    {
        function HeaderEcho($Title, $assets, $itemPlus) {
            $res = '
                <!DOCTYPE html>          
                <html>
                <head>
            ';
        
            if (is_array($assets)) {
                foreach ($assets as $asset) {
                    $type = $asset[0];
                    $link = $asset[1];
                    $extra = isset($asset[2]) ? $asset[2] : null;
        
                    if ($type == 0) {
                        $res .= '<meta ' . $link . '>';
                    } elseif ($type == 1) {
                        $res .= '<link rel="stylesheet" type="text/css" href="' . $link . '"';
                        if ($extra !== null) {
                            $res .= ' ' . $extra;
                        }
                        $res .= '>';
                    } elseif ($type == 2) {
                        $res .= '<script src="' . $link . '"';
                        if ($extra !== null) {
                            $res .= ' ' . $extra;
                        }
                        $res .= '></script>';
                    }
                }
            }
        
            $res .= '
                    <link rel="shortcut icon" href="'.$itemPlus.'">
                    <title>'.$Title.'</title>
                </head>
            ';
        
            echo $res;
        }
        
        function foot(){
            $res = '
                </html>
            ';
            echo($res);
        }
        
        function mensage($txt){
            echo '<script>alert("'.$txt.'");</script>';
        }

        function Atalho($pag) {
            echo '<script>redirect("'.$pag.'");</script>';
        }

        function Cripto($Pala){
            return password_hash($Pala, PASSWORD_BCRYPT);
        }   
        
        function CriptoVer($Pass, $Hash){
            return password_verify($Pass, $Hash);
        }

        function CodLink($length) {
            $characters = '0123456789ABCDEFGILMOPQRT';
            $charactersLength = strlen($characters);
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        
            return $randomString;
        }

        function upload($file, $pastSave, $NewName){
            if ($file['error'] === 0) {
                $nome_arquivo = $pastSave .'/'. $NewName;

                if (move_uploaded_file($file['tmp_name'], $nome_arquivo)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return $GLOBALS['Tlw'][$_SESSION['Lg']][1] . $file['error'];
            }
        }
    }

    final class BankUse
    {
        public $NameTable;
        public $Dates;

        function InsertTable($pdo, $Vls, $Vers, $Configs){
            $VersToText = '';
            foreach ($Vers as $key => $ver) {
                if ($key === 0) {
                    $VersToText .= $this->Dates[$ver].'= :'.$this->Dates[$ver];
                } else {
                    $VersToText .= ' '. $Configs[0][$key - 1].' '.$this->Dates[$ver].'= :'.$this->Dates[$ver];
                }
            }

            $sql = "SELECT * FROM ".$this->NameTable." WHERE ".$VersToText;
            $stmt = $pdo->prepare($sql);
            foreach($Vers as $key => $ver){
                $dateParam = ':'.$this->Dates[$ver];
                $stmt->bindParam($dateParam, $Vls[$ver]);
            }
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $GLOBALS['Tlw'][$_SESSION['Lg']][2];
            }else{
                try {
                    $DtsToText = implode(', ', $this->Dates);
                    $VlsToText = '';
                    foreach($Vls as $key => $vl){
                        $valueParam = ':'.$this->Dates[$key];

                        if($key === (count($Vls) - 1)){
                            $VlsToText .= $valueParam;
                        }else{
                            $VlsToText .= $valueParam.', ';
                        }
                    }

                    $sql = "INSERT INTO ".$this->NameTable." (".$DtsToText.") VALUES (".$VlsToText.")";
                    $stmt = $pdo->prepare($sql);
                    foreach($Vls as $key => $vl){
                        $dateParam = ':'.$this->Dates[$key];
                        $stmt->bindParam($dateParam, $Vls[$key]);
                    }

                    if ($stmt->execute()) {
                        return $GLOBALS['Tlw'][$_SESSION['Lg']][3];
                    } else {
                        throw new Exception($GLOBALS['Tlw'][$_SESSION['Lg']][0]);
                    }
                } catch (PDOException $e) {
                    return $GLOBALS['Tlw'][$_SESSION['Lg']][0] . $e->getMessage();
                }
            }
        }

        function GetTable($pdo, $DateRequire, $Where){
            if($DateRequire == ""){
                $DateRequire = "*";
            }
            try{
                $sql = "SELECT ".$DateRequire." FROM ".$this->NameTable." ".$Where;
                $stmt = $pdo->prepare($sql);
                if($stmt->execute()){
                    if($stmt->rowCount() > 0){
                        return $stmt;
                    }else{
                        return $GLOBALS['Tlw'][$_SESSION['Lg']][5];
                    }
                }else{
                    throw new Exception($GLOBALS['Tlw'][$_SESSION['Lg']][0]);
                }
            } catch(PDOException $e){
                return $GLOBALS['Tlw'][$_SESSION['Lg']][0].$e->getMessage();
            }
        }

        function UpdateTable($pdo, $UpdateData, $Values, $Where, $WhereValues) {
            $Updates = '';
            foreach ($UpdateData as $key => $column) {
                if ($key === 0) {
                    $Updates .= $column . ' = :' . $column;
                } else {
                    $Updates .= ', ' . $column . ' = :' . $column;
                }
            }
    
            $sql = "UPDATE " . $this->NameTable . " SET " . $Updates . " WHERE " . $Where;
            $stmt = $pdo->prepare($sql);
    
            foreach ($UpdateData as $column) {
                $param = ':' . $column;
                $value = $Values[$column];
                $stmt->bindParam($param, $value);
            }
    
            foreach ($WhereValues as $param => $value) {
                $stmt->bindParam($param, $value);
            }
    
            if ($stmt->execute()) {
                return $GLOBALS['Tlw'][$_SESSION['Lg']][6];
            } else {
                throw new Exception($GLOBALS['Tlw'][$_SESSION['Lg']][7]);
            }
        }
        
        function SearchTable($pdo, $column, $searchTerm){
            try {
                $sql = "SELECT * FROM ".$this->NameTable." WHERE ".$column." LIKE :searchTerm";
                $stmt = $pdo->prepare($sql);
                $searchTerm = "%".$searchTerm."%";
                $stmt->bindParam(':searchTerm', $searchTerm);
                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        return $GLOBALS['Tlw'][$_SESSION['Lg']][5]; // Not Found
                    }
                } else {
                    throw new Exception($GLOBALS['Tlw'][$_SESSION['Lg']][0]); // Error
                }
            } catch (PDOException $e) {
                return $GLOBALS['Tlw'][$_SESSION['Lg']][0].$e->getMessage(); // Error: {message}
            }
        }
    }
?>