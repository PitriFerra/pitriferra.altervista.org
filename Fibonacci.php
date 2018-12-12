<?php
session_start();
if(array_key_exists('LANG', $_GET)) $_SESSION['LANG'] = $_GET['LANG'];
if(!array_key_exists('LANG', $_SESSION)) $_SESSION['LANG'] = 'IT';
include $_SESSION['LANG'].".php";
?>

<h1 align="center" style="color: red; padding-top: 25px"><?=$LANG['FibonacciTitolo'];?></h1>

<?php
$tipo = $_GET['type'];
    
if($tipo == 0){
?>

  <p align="center" ><b><?=$LANG['CifraSinistra'];?></b></p>
        
<?php
}else{
  $N = $_POST['N'];

  if($N < 0){ 
?>

    <p align="center" ><b><?=$LANG['Errore0'];?></b></p>
        
<?php }else{ ?>

    <table align="center" style="border-spacing: 10px">
      <tr>
        <th><?=$LANG['Posizione'];?></th>
        <th><?=$LANG['Numero'];?></th>
      <tr>

<?php
      $num = 1;
      $prec = 0;
      $i = 0;

      while($i < $N && $i < 1476){
      	$tmp = $num;          	
?>

        <tr>
          <th><?php echo $i + 1; ?></th>
          <th><?php echo $num; ?></th>
        </tr>
            
<?php
        $num = $num + $prec;
        $prec = $tmp;
        $i++;
      }
?>

	  </table>
      
<?php
  }
}