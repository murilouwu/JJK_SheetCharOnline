<?php
	include('assets/php/PhpMain.php');
    
	$html = new HtmlBased();
    $html->HeaderEcho(
        $GLOBALS['Tlw'][$_SESSION['Lg']][8], 
        [
            [0, 'http-equiv="X-UA-Compatible" content="IE=edge"'],
            [0, 'name="viewport" content="width=device-width, initial-scale=1.0"'],
            [1, 'assets/css/index.css'],
            [2, 'assets/java/script.js'],
            [2, 'https://kit.fontawesome.com/39cab4bf95.js', 'crossorigin="anonymous"'],
            [2, 'https://code.jquery.com/jquery-3.2.1.slim.js', 'integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg=" crossorigin="anonymous"'],
        ],
        'assets/imgs/Logo.png'
    );

    if(!isset($_SESSION['Lg'])){
        $_SESSION['Lg'] = "Português";
    }
?>
    <div class="container">
        <div class="BlockIn">
            <div class="TopTitle">
                <h1 class="TitleGame">
                    <?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][9]?>
                </h1>
            </div>
            <div class="DonwBtns">
                <div class="iconsContact">
                    <div class="icons">
                        <i class="fab fa-github-square"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-xing"></i>
                    </div>
                    V.01
                </div>
                <div class="BntsMenu">
                    <a href="New.php" class="btn">
                        <span class="budd"></span><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][10]?><span class="budd"></span>
                    </a>
                    <a href="#" class="btn">
                        <span class="budd"></span><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][11]?><span class="budd"></span>
                    </a>
                    <a href="LinkCod.php" class="btn">
                        <span class="budd"></span><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][12]?><span class="budd"></span>
                    </a>
                    <a href="Creditos.php" class="btn">
                        <span class="budd"></span><?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][13]?><span class="budd"></span>
                    </a>
                    <a href="assets/php/Lg.php" class="btn">
                        <span class="budd"></span><?php echo $_SESSION['Lg']?><span class="budd"></span>
                    </a>
                </div>
                <div class="LogoChar">
                    <div class="Logo"></div>
                    <?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][14]?>
                </div>
            </div>
        </div>
    </div>
<?php 
    $html->foot();
?>