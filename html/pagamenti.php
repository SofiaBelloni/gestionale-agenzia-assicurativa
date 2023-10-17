<?php
require_once 'bootstrap.php';

if(isset($_POST["codCliente"])){

  //checkClient()
  if($dbh->checkClientPresence($_POST["codCliente"])){
    $templateParams["client_code"] = $_POST["codCliente"];
  }else{
    $templateParams["code_error_payment"] ="Codice Cliente inesistente!";
  }
}

if(isset($_POST["contractSelect-text"][0])){
  //checkEmploeeExistence
  if($dbh->checkEmployeePresence($_POST["employee"])){
    //add_payment
    $dbh->addNewPayment($_POST["contractSelect-text"][0], $_POST["amount"], date("Y-m-d", strtotime($_POST["date"])), $_POST["employee"]);
    $templateParams["add_payment"] = "Pagamento registrato con successo!";
  }else{
    $templateParams["payment_error"] ="Codice Impiegato errato!";
  }
}

$templateParams["name"]="pagamenti-template.php";
require './template/base-template.php';
?>
