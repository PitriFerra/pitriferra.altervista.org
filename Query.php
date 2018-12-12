<?php
$mysqli = new mysqli("localhost", $username, $password, $database);
$mysqli->select_db($database) or die("Errore 1: Impossibile connettersi al database!");
session_start();
if(array_key_exists('LANG', $_GET))$_SESSION['LANG'] = $_GET['LANG'];
if(!array_key_exists('LANG', $_SESSION))$_SESSION['LANG'] = 'IT';
include $_SESSION['LANG'].".php";
?>

<h1 align="center" style="color: red; padding-top: 25px"><?=$LANG['DatiFamiglia'];?></h1>

<?php   
switch($_GET['type']){
  case 0:
?>

		  <p align="center" ><b><?=$LANG['FunzioneSinistra'];?></b></p>
                
<?php
          break;
                
  case 1: 
          $sql = "SELECT Familiare.Nome, Scontrino.Importo
                  FROM Scontrino, Familiare
                  WHERE Scontrino.ID_Familiare = Familiare.ID_Familiare AND Scontrino.Importo = 
                  	(SELECT MAX(Importo) 
                     FROM Scontrino)";
          $result = $mysqli->query($sql);
          $arrayNome = array();
          $arrayImportoMassimo = array();

          while($row = $result->fetch_assoc()){
            array_push($arrayNome, $row["Nome"]);
            array_push($arrayImportoMassimo, $row["Importo"]);
          }
?>

          <table align="center" style="border-spacing: 10px">
            <tr>
              <th><?=$LANG['NomeFamiliare'];?></th>
              <th><?=$LANG['Importo'];?></th>
            </tr>

<?php
            for($i = 0; $i < count($arrayNome);$i++){
?>
                  
              <tr>
                <th><?php echo $arrayNome[$i];?></th>
                <th><?php echo $arrayImportoMassimo[$i];?></th>
              </tr>
                  
<?php
            }
?>
                  
          </table>
                
<?php
          break;
                        
  case 2: 
          $Mese = $_GET['Mese'];
          $sql = "SELECT SUM(Scontrino.Importo) AS ImportoTotale, Familiare.Nome
                  FROM Scontrino, Familiare
                  WHERE Scontrino.ID_Familiare = Familiare.ID_Familiare AND MONTH(Scontrino.DataSpesa) = MONTH('$Mese')
                  GROUP BY Scontrino.ID_Familiare
                  ORDER BY ImportoTotale desc";
          $result = $mysqli->query($sql) or die($mysqli->error);
          $arrayNome = array();
          $arrayImporto = array();

          while($row = $result->fetch_assoc()){
            array_push($arrayNome, $row["Nome"]);
            array_push($arrayImporto, $row["ImportoTotale"]);
          }
?>
                
          <table align="center" style="border-spacing: 10px">
            <tr>
              <th><?=$LANG['NomeFamiliare'];?></th>
              <th><?=$LANG['ImportoTotale'];?></th>
            </tr>

<?php
            for($i = 0; $i < count($arrayNome);$i++){
?>
                  
              <tr>
                <th><?php echo $arrayNome[$i];?></th>
                <th><?php echo $arrayImporto[$i];?></th>
              </tr>
                  
<?php
            }
?>
                  
          </table>
                
<?php
          break;
                        
  case 3: 
          $Market = $_GET['ID'];
          $sql = "SELECT Scontrino.Importo, Market.Nome AS NomeMarket, Familiare.Nome AS NomeFamiliare
                  FROM Scontrino, Market, Familiare
                  WHERE Scontrino.ID_Market = Market.ID_Market AND Scontrino.ID_Familiare = Familiare.ID_Familiare 
                    AND Scontrino.ID_Market = '$Market' AND Scontrino.Importo = 
                      (SELECT MAX(Importo) 
                       FROM Scontrino
                       WHERE Scontrino.ID_Market = '$Market')";
          $result = $mysqli->query($sql) or die($mysqli->error);
          $arrayNomeFamiliare = array();
          $arrayNomeMarket = array();
          $arrayImporto = array();

          while($row = $result->fetch_assoc()){
            array_push($arrayNomeFamiliare, $row["NomeFamiliare"]);
            array_push($arrayNomeMarket, $row["NomeMarket"]);
            array_push($arrayImporto, $row["Importo"]);
          }
?>
                
          <table align="center" style="border-spacing: 10px">
            <tr>
              <th><?=$LANG['NomeFamiliare'];?></th>
              <th><?=$LANG['NomeMarket'];?></th>
              <th><?=$LANG['ImportoMassimo'];?></th>
            </tr>

<?php
            for($i = 0; $i < count($arrayNomeMarket);$i++){
?>
                  
              <tr>
                <th><?php echo $arrayNomeFamiliare[$i];?></th>
                <th><?php echo $arrayNomeMarket[$i];?></th>
                <th><?php echo $arrayImporto[$i];?></th>
              </tr>
                  
<?php
            }
?>
                  
          </table>
                
<?php
          break;
}
    
$mysqli->close();