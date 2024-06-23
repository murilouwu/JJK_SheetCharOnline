<?php
	include('assets/php/PhpMain.php');
    
	$html = new HtmlBased();
    $html->HeaderEcho(
        $GLOBALS['Tlw'][$_SESSION['Lg']][12], 
        [
            [0, 'http-equiv="X-UA-Compatible" content="IE=edge"'],
            [0, 'name="viewport" content="width=device-width, initial-scale=1.0"'],
            [1, 'assets/css/lobby.css'],
            [2, 'assets/java/script.js'],
            [2, 'https://kit.fontawesome.com/39cab4bf95.js', 'crossorigin="anonymous"'],
            [2, 'https://code.jquery.com/jquery-3.2.1.slim.js', 'integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg=" crossorigin="anonymous"'],
            [2, 'https://code.jquery.com/jquery-3.2.1.min.js'],
        ],
        'assets/imgs/Logo.png'
    );

    if(!isset($_SESSION['Lg'])){
        $html->Atalho('index.php');
    }else if(!isset($_SESSION['user'])) {
        $html->Atalho('LinkCod.php');
    }

    if($_SESSION['user']['Master']) {
        // Se o usuário for o dono, atualize o status no banco de dados
        $bank = new BankUse();
        $bank->NameTable = 'host';
        $bank->Dates= array('nameGame', 'nameMaster', 'pass', 'stDono', 'idCod', 'img');
        
        // Dados para atualizar
        $UpdateData = array('stDono');
        $Values = array('stDono' => 1);  // 1 para 'online'
        $Where = 'idCod = :code';
        $WhereValues = array(':code' => $_SESSION['user']['Host']);
        
        try {
            $result = $bank->UpdateTable($pdo, $UpdateData, $Values, $Where, $WhereValues);
            if ($result !== $GLOBALS['Tlw'][$_SESSION['Lg']][6]) {
                throw new Exception($result);
            }
        } catch (Exception $e) {
            // Handle error
            echo 'Error updating owner status: ',  $e->getMessage(), "\n";
        }
    }
?>
    <div class="lobby">
        <div class="Info">
            <h1 class="NameRpg"><?php echo $_SESSION['host']['nameGame']?></h1>
            <h2 class="host">Server Code: <?php echo $_SESSION['user']['Host']?></h2>
        </div>
        <div class="players">
            <div class="player Master">
                <div class="Perfil King"></div>
                <div class="name"><?php echo $_SESSION['host']['nameMaster']?></div>
                <div class="barStatus barStOff"></div>
                <!--
                    .Master e King é só para o dono
                    .barStOn ==> <div class="barStatus barStOn"></div>  => verde, ou seja ele está
                    .barStOn ==> <div class="barStatus barStOff"></div>  => vermelho, ou seja não está
                -->
            </div>
            <div class="player">
                <div class="Perfil"></div>
                <div class="name">nomeA</div>
                <div class="barStatus barStOff"></div>
            </div>
            <div class="player">
                <div class="Perfil"></div>
                <div class="name">nomeB</div>
                <div class="barStatus barStOff"></div>
            </div>
    </div>
    <script>
        window.addEventListener('beforeunload', function (e) {
            navigator.sendBeacon('assets/php/logout.php');
        });
    </script>
<?php
    $html->foot();
?>