<?php
    include('PhpMain.php');
    header('Content-Type: application/json');

    $currentArray = $GLOBALS['Tlw'][$_SESSION['Lg']];
    $currentIndex = array_search($_SESSION['Lg'], array_keys($GLOBALS['Tlw']));
    $nextIndex = ($currentIndex + 1) % count($GLOBALS['Tlw']);

    $_SESSION['Lg'] = array_keys($GLOBALS['Tlw'])[$nextIndex];

    $html = new HtmlBased();
    $html->Atalho('../../index.php');
?>