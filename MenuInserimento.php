<?php
session_start();
if(array_key_exists('LANG', $_GET))$_SESSION['LANG'] = $_GET['LANG'];
if(!array_key_exists('LANG', $_SESSION))$_SESSION['LANG'] = 'IT';
include $_SESSION['LANG'].".php";
$mysqli = new mysqli("localhost", $username, $password, $database);
$mysqli->select_db($database) or die("Errore 1: Impossibile connettersi al database!");
$mydate=getdate(date("U"));
?>

<h1 align="center" style="color: red; padding-top: 25px"><?=$LANG['Inserimento'];?></h1>
<table align="center" border=1 cellpadding="5px" cellspacing="0px">
  <form action="Inserimento.php">
  	<tr>
      <th>
        <input required name="NomeFamiliare" type="text">
        <button type="submit"><?=$LANG['AggiungiFamiliare'];?></button>
		<input hidden max="1" min="1" name="type" type="number" value="1">
      </th>
    <tr>
  </form>

  <form action="Inserimento.php">
  	<tr>
      <th>
        <input required name="NomeMarket" type="text">
        <button type="submit"><?=$LANG['AggiungiMarket'];?></button>      
		<input hidden max="2" min="2" name="type" type="number" value="2">
      </th>
    <tr>
  </form>

  <form action="Inserimento.php">
  	<tr>
      <th>
      	<p><?=$LANG['Familiare'];?>: 
      
<?php             	
          $sql = "SELECT *
                  FROM Familiare";
          $result = $mysqli->query($sql);
          $arrayNomeFamiliare = array();
          $arrayIDFamiliare = array();

          while($row = $result->fetch_assoc()){
            array_push($arrayNomeFamiliare, $row["Nome"]);
            array_push($arrayIDFamiliare, $row["ID_Familiare"]);
          }
?>

          <select name="IDFamiliare">

<?php
            for($i = 0; $i < count($arrayIDFamiliare); $i++){
?>

              <option value="<?php echo $arrayIDFamiliare[$i]; ?>"><?php echo $arrayNomeFamiliare[$i]; ?></option>

<?php
            }	        
?>

          </select>
        </p>
        
        <p><?=$LANG['Market'];?>: 

<?php             	
          $sql = "SELECT *
                  FROM Market";
          $result = $mysqli->query($sql);
          $arrayNomeMarket = array();
          $arrayIDMarket = array();

          while($row = $result->fetch_assoc()){
            array_push($arrayNomeMarket, $row["Nome"]);
            array_push($arrayIDMarket, $row["ID_Market"]);
          }
?>

          <select name="IDMarket">

<?php
            for($i = 0; $i < count($arrayIDMarket); $i++){
?>

              <option value="<?php echo $arrayIDMarket[$i]; ?>"><?php echo $arrayNomeMarket[$i]; ?></option>

<?php
            }	
?>

          </select>
        </p> 
        <p><?=$LANG['Importo'];?>: <input required min="1" name="Importo" type="number"></p> 
        <p><?=$LANG['DataSpesa'];?>: <input required max="<?php echo "$mydate[year]-$mydate[mon]-$mydate[mday]"; ?>" name="Data" type="date"></p> 
        <button type="submit"><?=$LANG['AggiungiScontrino'];?></button>
		<input hidden max="3" min="3" name="type" type="number" value="3">
      </th>
    <tr>
  </form>
</table>