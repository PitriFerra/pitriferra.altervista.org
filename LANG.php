<?php
session_start();
if(array_key_exists('LANG', $_GET))$_SESSION['LANG'] = $_GET['LANG'];
if(!array_key_exists('LANG', $_SESSION))$_SESSION['LANG'] = 'IT';
include $_SESSION['LANG'].".php";
?>

<a href="index.php?LANG=EN" target="_top"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Flag_of_the_United_Kingdom.svg/280px-Flag_of_the_United_Kingdom.svg.png" width="40"></a>
<a href="index.php?LANG=IT" target="_top"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Flag_of_Italy.svg/280px-Flag_of_Italy.svg.png" width="30"></a>