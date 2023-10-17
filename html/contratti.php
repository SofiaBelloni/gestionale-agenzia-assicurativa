<?php
require_once 'bootstrap.php';

$templateParams["name"]="contratti-template.php";

if(count($_POST) > 5){
  //checkCodClientExistence
  //checkCodFAExistance
  if($dbh->checkClientPresence($_POST["codCliente"]) && $dbh->checkFinancialAdvisorPresence($_POST["codConsulente"])){
    switch ($_POST["productSelect-text"][0]) {
      case '1':
      //Investimento a premio unico
        $dbh->addNewContractIPU("IPU",date("Y-m-d", strtotime($_POST["subscription"])), date("Y-m-d", strtotime($_POST["expiration"])), "0", $_POST["interests"], $_POST["investment"], $_POST["codConsulente"], $_POST["codCliente"]);
        break;
      case '2':
      //Piano di risparmio a tempo determinato
        $dbh->addNewContractPTD("PTD",date("Y-m-d", strtotime($_POST["subscription"])), date("Y-m-d", strtotime($_POST["expiration"])), "0", $_POST["interests"], $_POST["monthlyPayment"], $_POST["codConsulente"], $_POST["codCliente"]);
        break;
      case '3':
      //Fondo previdenziale
        $dbh->addNewContractFP("FP",date("Y-m-d", strtotime($_POST["subscription"])), date("Y-m-d", strtotime($_POST["expiration"])), "0", $_POST["interests"], $_POST["codConsulente"], $_POST["codCliente"]);
        break;
      default:
    }
    $templateParams["add_contract"] = "Nuovo contratto registrato correttamente!";
  }
  else{
    $templateParams["contract_error"] = "Errore: impossibile proseguire con la registrazione";
  }
}

if(isset($_GET["visualizza"])){
  $templateParams["name"]="contratti-in-scadenza-template.php";
}

if(isset($_GET["liquida"])){
  $templateParams["name"]="contratti-da-liquidare-template.php";
}

if(isset($_GET["codImpiegato"])){
  if($dbh->checkEmployeePresence($_GET["codImpiegato"])){
    $dbh->addNewLiquidation($_GET["codContratto"], $_GET["codImpiegato"], date("Y-m-d"));
    $templateParams["liquidation_success"] = "Liquidazione effettuata correttamente!";
  }else{
    $templateParams["liquidation_error"] = "Codice Impiegato inesistente!";
  }
  $templateParams["name"]="contratti-da-liquidare-template.php";
}


require './template/base-template.php';
?>
