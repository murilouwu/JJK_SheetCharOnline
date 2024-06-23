<?php
	include('assets/php/PhpMain.php');
    
	$html = new HtmlBased();
    $html->HeaderEcho(
        $GLOBALS['Tlw'][$_SESSION['Lg']][12], 
        [
            [0, 'http-equiv="X-UA-Compatible" content="IE=edge"'],
            [0, 'name="viewport" content="width=device-width, initial-scale=1.0"'],
            [1, 'assets/css/log.css'],
            [2, 'assets/java/script.js'],
            [2, 'https://kit.fontawesome.com/39cab4bf95.js', 'crossorigin="anonymous"'],
            [2, 'https://code.jquery.com/jquery-3.2.1.slim.js', 'integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg=" crossorigin="anonymous"'],
            [2, 'https://code.jquery.com/jquery-3.2.1.min.js'],
        ],
        'assets/imgs/Logo.png'
    );

    if(!isset($_SESSION['Lg'])){
        $html->Atalho('index.php');
    }
?>
<body>
    <button class="Back" onclick="redirect('index.php')"><i class="fas fa-caret-left"></i></button>
    <div class="PandaHelp">
        <img src="assets/imgs/Panda.png" alt="" class="panda">
        <div class="blockText">
            <img src="assets/imgs/Balan.png" class="Help">
            <p class="block" id="TextaoLegal">
                <?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][36]; ?>
            </p>
        </div>
    </div>
    <form class="log" method="POST">
        <label class="Enter"><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][33]; ?></label>
        <input type="text" class="pes" minlength="6" maxlength="6" placeholder="<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][34]; ?>" id="Code" name="code">
        <div class="check">
            <?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][35]; ?>
            <input type="checkbox" id="checkMark">
            <label for="checkMark"></label>
        </div>
        <div class="inputs">
            <input type="text" name="nameUser" class="inputUseInfo" placeholder="nickname" id="inputUseInfo">
            <input type="text" name="MasterName" class="inputUseInfo Master" placeholder="<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][24]?>" id="nomeMaster">
            <input type="password" name="MasterPass" class="inputUseInfo Master" placeholder="<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][25]?>" id="senhaMaster">
        </div> 
        <div class="submit">
            <input type="submit" value="<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][11]?>" class="env" name="env">
        </div>
    </form>
    <script>
        const textaoBalon = document.querySelector('#TextaoLegal');
        const ObjsDiv = [
            document.querySelector('.check'),
            document.querySelector('.submit'),
            document.querySelector('.inputs'),
            document.querySelector('#inputUseInfo'),
            Array.from(document.querySelectorAll('.Master')),
        ];

        $("#Code").on('input', function(){
            let code = $(this).val();
            ObjsDiv[3].value = '';
            ObjsDiv[4].forEach(element => element.value = '');
            FormInputs();

            if(code.length < 6){
                ObjsDiv[0].style.display = 'none';
                ObjsDiv[1].style.display = 'none';
                ObjsDiv[2].style.display = 'none';
            };

            if(code.length == 0){
                textaoBalon.innerHTML = "<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][36]; ?>";
            }else if(code.length <= 3){
                textaoBalon.innerHTML = "<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][37]; ?>";
            }else if(code.length > 3){
                $.ajax({
                url: 'assets/php/SearchCod.php',
                type: 'POST',
                data: {
                    code: code 
                },
                success: function(response) {
                    if (response.data) {
                        if(code.length < 6){
                            textaoBalon.innerHTML = `<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][38]; ?> ${response.data.nameGame}<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][39]; ?> ${response.data.idCod}`;
                        }else{
                            textaoBalon.innerHTML = `<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][38]; ?> ${response.data.nameGame}`;
                            ObjsDiv[0].style.display = 'flex';
                            ObjsDiv[1].style.display = 'flex';
                            ObjsDiv[2].style.display = 'flex';
                        }
                    }else{
                        textaoBalon.innerHTML = "<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][40]; ?>";
                        ObjsDiv[0].style.display = 'none';
                        ObjsDiv[1].style.display = 'none';
                        ObjsDiv[2].style.display = 'none';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
            }
        });

        $('#checkMark').change(function() {
            if($(this).is(':checked')) {
                ObjsDiv[3].style.display = 'none';
                ObjsDiv[3].value = '';
                ObjsDiv[4].forEach(element => element.style.display = 'flex');
            } else {
                ObjsDiv[3].style.display = 'flex';
                ObjsDiv[4].forEach(element => element.value = '');
                ObjsDiv[4].forEach(element => element.style.display = 'none');
            };

            FormInputs();
        });

        function FormInputs() {
            const Cod = document.getElementById('Code').value.trim();
            const nickname = ObjsDiv[3].value.trim();
            const name = ObjsDiv[4][0].value.trim();
            const senha = ObjsDiv[4][1].value.trim();

            const submitButton = document.querySelector('.env');

            if (Cod && (nickname || name && senha)){
                submitButton.removeAttribute('disabled');
            } else {
                submitButton.setAttribute('disabled', 'disabled');
            }
        }

        document.querySelectorAll('.inputUseInfo').forEach(input => {
            input.addEventListener('input', FormInputs);
        });
    </script>
</body>
<?php
    $html->foot();
    function mensageBalon($text){
        echo '<script>textaoBalon.innerHTML = "'.$text.'";</script>';
    }

    if(isset($_POST['env'])){
        $code = $_POST['code'];
        $nickname = $_POST['nameUser'];
        $masterName = $_POST['MasterName'];
        $masterPass = $_POST['MasterPass'];

        $Funs = new HtmlBased();
        $bank = new BankUse();

        $bank->NameTable = 'host';
        $bank->Dates = array('nameGame', 'nameMaster', 'pass', 'stDono', 'idCod', 'img');
        $whereClause = "WHERE idCod = '".$code."';";
        $result = $bank->GetTable($pdo, "", $whereClause);
        
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        if (!empty($masterName) && !empty($masterPass)){
            $storedMasterPass = $row['pass'];
            
            if ($Funs->CriptoVer($masterPass, $storedMasterPass) && $masterName == $row['nameMaster']) {
                $_SESSION['user']['Host'] = $code;
                $_SESSION['user']['NameUser'] = $masterName;
                $_SESSION['user']['Master'] = true;
                $_SESSION['host'] = $row;

                $Funs->Atalho('lobby.php');
            }else {
                mensageBalon($GLOBALS['Tlw'][$_SESSION['Lg']][41]);
            }
        }else if (!empty($nickname)) {
            $_SESSION['user']['Host'] = $code;
            $_SESSION['user']['NameUser'] = $nickname;
            $_SESSION['user']['Master'] = false;
            $_SESSION['host'] = $row;

            $Funs->Atalho('lobby.php');
        }else{
            mensageBalon($GLOBALS['Tlw'][$_SESSION['Lg']][40]); 
        }
    }
?>