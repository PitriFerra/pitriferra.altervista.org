<?php
$mysqli = new mysqli("localhost", $username, $password, $database);
$mysqli->select_db($database) or die("Errore 1: Impossibile connettersi al database!");
session_start();
if(array_key_exists('LANG', $_GET))$_SESSION['LANG'] = $_GET['LANG'];
if(!array_key_exists('LANG', $_SESSION))$_SESSION['LANG'] = 'IT';
include $_SESSION['LANG'].".php";             	
$sql = "SELECT MONTH(Scontrino.DataSpesa) AS Mesi
        FROM Scontrino
        GROUP BY MONTH(Scontrino.DataSpesa)";
$result = $mysqli->query($sql);
$arrayMesi = array();

while($row = $result->fetch_assoc()) array_push($arrayMesi, $row["Mesi"]);
?>

<a href="index.php?LANG=EN" target="_top"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Flag_of_the_United_Kingdom.svg/280px-Flag_of_the_United_Kingdom.svg.png" width="40"></a>
<a href="index.php?LANG=IT" target="_top"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Flag_of_Italy.svg/280px-Flag_of_Italy.svg.png" width="30"></a>
<h1 align="center" style="color: red"><?=$LANG['Menu'];?></h1>
<form action="/Fibonacci.php?type=1" align="center" method="post">
  <input required min="0" max="1476" name="N" type="number"/>
  <button formtarget="Fibonacci" type="submit"><?=$LANG['Fibonacci'];?></button>            
</form>

<form action="/Query.php?type=1" align="center" method="post">
  <button formtarget="Query" type="submit"><?=$LANG['SpesaPiuAlta'];?></button>            
</form>

<form action="/Query.php" align="center" method="get">     
  <select name="Mese">

<?php
    for($i = 0; $i < count($arrayMesi); $i++){
      switch($arrayMesi[$i]){
        case "1":   
?>

                	<option value="0001-01-01"><?=$LANG['Gennaio'];?></option>

<?php
                  	break;
                  
        case "2": 
?>

                  	<option value="0001-02-01"><?=$LANG['Febbraio'];?></option>

<?php
				  	break;

        case "3": 
?>

                  	<option value="0001-03-01"><?=$LANG['Marzo'];?></option>

<?php
        		  	break;
                                  
        case "4": 
?>

				  	<option value="0001-04-01"><?=$LANG['Aprile'];?></option>

<?php
					break;
                                  
		case "5": 
?>

					<option value="0001-05-01"><?=$LANG['Maggio'];?></option>

<?php
                    break;
                                  
		case "6": 
?>

                    <option value="0001-06-01"><?=$LANG['Giugno'];?></option>

<?php
                    break;
                                  
		case "7": 
?>

                    <option value="0001-07-01"><?=$LANG['Luglio'];?></option>

<?php
                    break;
                                  
		case "8": 
?>

                    <option value="0001-08-01"><?=$LANG['Agosto'];?></option>

<?php
                    break;
                                  
		case "9": 
?>

                    <option value="0001-09-01"><?=$LANG['Settembre'];?></option>

<?php
                    break;
                                  
		case "10": 
?>

                    <option value="0001-10-01"><?=$LANG['Ottobre'];?></option>

<?php
                    break;
                                  
		case "11": 
?>

                    <option value="0001-11-01"><?=$LANG['Novembre'];?></option>

<?php
                    break;
                                  
		case "12":                       
?>

                    <option value="0001-12-01"><?=$LANG['Dicembre'];?></option>

<?php
                    break;                                   
	  }
    }
?>

  </select>        
  <input hidden max="2" min="2" name="type" type="number" value="2">
  <button formtarget="Query" type="submit"><?=$LANG['SpeseMensili'];?></button>
</form>

<form action="/Query.php" align="center" method="get"> 
        
<?php             	
  $sql = "SELECT *
          FROM Market
          WHERE EXISTS 
          	(SELECT Scontrino.ID_Market 
             FROM Scontrino
             WHERE Scontrino.ID_Market = Market.ID_Market)";
  $result = $mysqli->query($sql) or die($mysqli->error);
  $arrayNome = array();
  $arrayID = array();

  while($row = $result->fetch_assoc()){
    array_push($arrayNome, $row["Nome"]);
    array_push($arrayID, $row["ID_Market"]);
  }
?>

  <select name="ID">

<?php
    for($i = 0; $i < count($arrayID); $i++){
?>
          
      <option value="<?php echo $arrayID[$i]; ?>"><?php echo $arrayNome[$i]; ?></option>

<?php
    }	        
?>
          
  </select> 
  <input hidden max="3" min="3" name="type" type="number" value="3">
  <button formtarget="Query" type="submit"><?=$LANG['SpesaAltaMarket'];?></button>
</form>