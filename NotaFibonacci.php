<?php
session_start();
if(array_key_exists('LANG', $_GET))$_SESSION['LANG'] = $_GET['LANG'];
if(!array_key_exists('LANG', $_SESSION))$_SESSION['LANG'] = 'IT';
include $_SESSION['LANG'].".php";
?>

<p align="right" style="font-size: 15px"><?=$LANG['NotaFibonacci'];?></p>