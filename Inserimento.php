<?php
$mysqli = new mysqli("localhost", $username, $password, $database);
$mysqli->select_db($database) or die("Errore 1: Impossibile connettersi al database!");

switch($_GET['type']){
  case 1: 
         $nome = $_GET['NomeFamiliare'];
    	 $sql = "INSERT INTO Familiare (Nome)
                 VALUES ('$nome')";
         $mysqli->query($sql);
    	 break;
            
  case 2:
    	 $nome = $_GET['NomeMarket'];
    	 $sql = "INSERT INTO Market (Nome)
                 VALUES ('$nome')";
         $mysqli->query($sql);
         break;
            
  case 3:
    	  $familiare = $_GET['IDFamiliare'];
          $market = $_GET['IDMarket'];
          $importo = $_GET['Importo'];
          $data = $_GET['Data'];
          echo "$familiare, $market, $importo, $data";
          $sql = "INSERT INTO Scontrino (ID_Familiare, ID_Market, Importo, DataSpesa)
            	  VALUES ('$familiare', '$market', '$importo', '$data')";
          $mysqli->query($sql);
    	  break;
}

echo "<script>top.window.location = '/index.php?LANG=$lingua'</script>";