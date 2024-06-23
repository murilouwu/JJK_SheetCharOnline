<?php
    session_start();
    include('assets/php/PhpMain.php');

    if (isset($_SESSION['user']) && $_SESSION['user']['Master']) {
        $bank = new BankUse();
        $bank->NameTable = 'host';
        $bank->Dates= array('nameGame', 'nameMaster', 'pass', 'stDono', 'idCod', 'img');

        // Dados para atualizar
        $UpdateData = array('stDono');
        $Values = array('stDono' => 'offline');
        $Where = 'idCod = :code';
        $WhereValues = array(':code' => $code);

        try {
            $bank->UpdateTable($pdo, $UpdateData, $Values, $Where, $WhereValues);
        } catch (Exception $e) {
            // Handle error
            echo 'Error updating owner status: ',  $e->getMessage(), "\n";
        }
    }
?>