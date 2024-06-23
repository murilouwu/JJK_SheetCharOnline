<?php
	include('assets/php/PhpMain.php');
	$html = new HtmlBased();
    $html->HeaderEcho(
        'New Server', 
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
    
?>
    <style>
        .coluns{
            margin: 1vw;
            display: flex;
            flex-direction: row;
            background-color: rgba(0 0 0/ 0.2);
            backdrop-filter: blur(2px) brightness(56%) sepia(50%) hue-rotate(-53deg) contrast(115%) saturate(64%);
        }
            .col{
                display: flex;
                flex-direction: column;
                padding: 1vw 1vw;
                color: var(--corA);
                border-left: 2px solid var(--corA);
            }
                .item{
                    padding: 0vw;
                    height: 20vh;
                    border-top: 2px solid black;
                    text-align: center;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-direction: column;
                    color: var(--corD);
                    font-weight: bold;
                }
    </style>
    <h1>GLOBALS['Tlw'][$_SESSION['Lg']][32]</h1>
    <div class="coluns">
        <?php
            foreach($GLOBALS['Tlw'] as $key => $ver){
                echo '<div class="col">';
                echo '  <h2>'.$key.'</h2>';

                for($i=0; $i<count($GLOBALS['Tlw'][$key]); $i++){
                    echo '<div class="item">'.$i.'-<br>'.$GLOBALS['Tlw'][$key][$i].'</div>';
                }
                echo '</div>';
            }
        ?>
        
        <div class="col"></div>
        <div class="col"></div>
    </div>
<?php
    $html->foot();
?>