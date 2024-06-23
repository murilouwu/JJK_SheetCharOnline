<?php
	include('assets/php/PhpMain.php');
	$html = new HtmlBased();
    
    $html->HeaderEcho(
        $GLOBALS['Tlw'][$_SESSION['Lg']][18], 
        [
            [0, 'http-equiv="X-UA-Compatible" content="IE=edge"'],
            [0, 'name="viewport" content="width=device-width, initial-scale=1.0"'],
            [1, 'assets/css/New.css'],
            [2, 'assets/java/script.js'],
            [2, 'https://kit.fontawesome.com/39cab4bf95.js', 'crossorigin="anonymous"'],
            [2, 'https://code.jquery.com/jquery-3.2.1.slim.js', 'integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg=" crossorigin="anonymous"'],
        ],
        'assets/imgs/Logo.png'
    );
    
    if(!isset($_SESSION['Lg'])){
        $html->Atalho('index.php');
    }
?>
    <div class="container">
        <div class="modal">
            <i class="fas fa-x exit" onclick="ocultar('.modal', 0)"></i>
            <h3><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][19]?></h3>
            <div class="BlockCopy">....</div>
            <button class="CopyUti" onclick="Copy(this, '.BlockCopy')"><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][20]?></button>
            <h5><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][21]?></h5>
            <img src="assets/imgs/Expli.png" class="Exp">
        </div>
        <div class="blockTrans">
            <div class="TrapRose"></div>
            <button class="Back" onclick="redirect('index.php')"><i class="fas fa-caret-left"></i></button>
            <button id="ModalOpen" class="Back Back2 Ocultar" onclick="ocultar('.modal', 1); disBtn()"><i class="fas fa-caret-right"></i> <?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][20]?></button>
            <h2><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][22]?></h2>
            <form id="Create" class="Construct" enctype="multipart/form-data">
                <div class="Img">
                    <img src="assets/imgs/UpLoad.png" class="Preset" onclick="adamCendler('#ImgServer')" id="ImgMost">
                    <input type="text" name="Title" placeholder="<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][23]?>" class="Title" id="title">
                    <input type="file" accept="image/*" id="ImgServer" class="Img" name="Image">
                </div>
                <div class="blockBasic">
                    <div class="inputs">
                        <input type="text" class="inputText" placeholder="<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][24]?>" name="NameInput" id="nameInput">
                        <input type="password" class="inputText" placeholder="<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][25]?>" name="SenhaInput" id="senhaInput" minlength="1" maxlength="20">
                        <input type="password" class="inputText" placeholder="<?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][26]?>" name="SenhaInput2" id="confirmSenhaInput" minlength="1" maxlength="20">
                    </div>
                    <div class="Balao">
                        <p id="senhaMatchMsg"><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][27]?></p>
                    </div>
                    <img src="assets/imgs/HakariAdd.png">
                    <div class="Submit">
                        <input type="submit" value="Envia" class="ocultar" id="EnviForm" disabled>
                        <label for="EnviForm"><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][22]?> <i class="fas fa-caret-right BtnEnv"></i></label>
                    </div>
                </div>
            </form>
        </div>
        <img src="assets/imgs/Yuji.png" class="YujiTranvEr">
    </div>
    <script>
        $("#ImgServer").change(function(){
            let most = "#ImgMost";
            PreViewImg(this, most);
        });

        function checkFormInputs() {
            const title = document.getElementById('title').value.trim();
            const nameInput = document.getElementById('nameInput').value.trim();
            const senhaInput = document.getElementById('senhaInput').value.trim();
            const confirmSenhaInput = document.getElementById('confirmSenhaInput').value.trim();
            const imageInput = document.getElementById('ImgServer').files.length > 0;

            const submitButton = document.getElementById('EnviForm');
            const classSub = document.querySelector('.Submit');
            const senhaMatchMsg = document.getElementById('senhaMatchMsg');

            $textIn = <?php echo json_encode($GLOBALS['Tlw'][$_SESSION['Lg']]);?>;

            if (senhaInput !== confirmSenhaInput) {
                submitButton.setAttribute('disabled', 'disabled');
                classSub.classList.remove('Abb');

                
                if(confirmSenhaInput == ""){
                    senhaMatchMsg.textContent = $textIn[28];
                } else if (senhaInput.startsWith(confirmSenhaInput)) {
                    senhaMatchMsg.textContent = $textIn[29];
                }else{
                    senhaMatchMsg.textContent = $textIn[30];
                }
                return;
            } else {
                if(senhaInput == ""){
                    senhaMatchMsg.textContent = $textIn[27];
                }else{
                    senhaMatchMsg.textContent = $textIn[31];
                }
            }

            if (title && nameInput && senhaInput && confirmSenhaInput && imageInput && (senhaInput === confirmSenhaInput)){
                submitButton.removeAttribute('disabled');
                classSub.classList.add('Abb');
                senhaMatchMsg.textContent = $textIn[32];
            } else {
                submitButton.setAttribute('disabled', 'disabled');
                classSub.classList.remove('Abb');
            }
        }

        function CodAtcion(codNum){
            let modal = document.querySelector('.modal');
            let cod = document.querySelector('.BlockCopy');
            let OpModal = document.querySelector('#ModalOpen');

            modal.style.display = "flex";
            OpModal.style.display = "flex";
            cod.innerHTML = codNum;
        }

        function disBtn(){
            let btn = document.querySelector('.CopyUti');
            btn.removeAttribute('disabled');
        };

        document.querySelectorAll('.inputText').forEach(input => {
            input.addEventListener('input', checkFormInputs);
        });

        document.getElementById('title').addEventListener('input', checkFormInputs);

        document.getElementById('ImgServer').addEventListener('change', checkFormInputs);

        document.getElementById('Create').addEventListener('submit', function(event){
            event.preventDefault();
            const formData = new FormData(this);

            fetch('MakeServer.php', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
            .then(data => {
                alert(data.Mensagem);
                CodAtcion(data.code);
            }).catch(error => console.error('Error:', error));
        });
    </script>
<?php 
    $html->foot();
?>