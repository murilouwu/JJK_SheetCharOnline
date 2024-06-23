<?php
	include('assets/php/PhpMain.php');
	$html = new HtmlBased();
    $html->HeaderEcho(
        $GLOBALS['Tlw'][$_SESSION['Lg']][15], 
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
        $html->Atalho('index.php');
    }
?>
    <div class="container">
        <div class="BlockIn">
            <div class="TopTitle">
                <button class="Back" onclick="redirect('index.php')"><i class="fas fa-caret-left"></i></button>
                <h1 class="TitleGame">
                    <?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][15]?>
                </h1>
            </div>
            <div class="DonwBtns">
                <div class="TextsCredits">
                    <?php echo $GLOBALS['Tlw'][$_SESSION['Lg']][16]?>
                    <div class="Contacts">
                        <i class="fa-brands fa-youtube" onclick="redirectNewPage('https://www.youtube.com/channel/UC5j326FDOeG70i3KixHsTSw')"></i>
                        <i class="fa-brands fa-facebook" onclick="redirectNewPage('https://www.facebook.com/murilo.gimenez.7543/')"></i>
                        <i class="fa-brands fa-twitter" onclick="redirectNewPage('https://twitter.com/v43410730')"></i>
                        <i class="fa-brands fa-instagram" onclick="redirectNewPage('https://www.instagram.com/murilaodasaladadedesenho/')"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    $html->foot();
?>