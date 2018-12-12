<?php
$lingua = $_GET['LANG'];

if($lingua == "") $lingua = "EN";
?>

<frameset cols="25%,*,25%">
  <frameset rows="50%,50%">
  	<frame src="Menu.php?LANG=<?php echo $lingua; ?>">
    <frame src="MenuInserimento.php?LANG=<?php echo $lingua; ?>">
  </frameset>
  
  <frameset noresize frameborder=0 rows="*,5%">
  	<frame name="Fibonacci" src="Fibonacci.php?LANG=<?php echo $lingua; ?>">
    <frame src="NotaFibonacci.php?LANG=<?php echo $lingua; ?>">
  </frameset>  
  <frame name="Query" src="Query.php?type=0&?LANG=<?php echo $lingua; ?>">
</frameset>