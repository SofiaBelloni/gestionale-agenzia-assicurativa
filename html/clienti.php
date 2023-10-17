<?php
require_once 'bootstrap.php';
$templateParams["name"]="clienti-template.php";

if(isset($_POST["CF"])){
  $dbh->addNewClient($_POST["CF"], $_POST["name"], $_POST["surname"], date("Y-m-d", strtotime($_POST["birthdate"])), $_POST["address"], $_POST["house_number"], $_POST["zip_code"], $_POST["telephone"]);
  $templateParams["add_client"] = "Nuovo cliente registrato correttamente!";
}

if(isset($_POST["codCliente"])){
  //CheckCodClientExistence
  if($dbh->checkClientPresence($_POST["codCliente"])){
    //show details
    $templateParams["client_code"] = $_POST["codCliente"]; 
    $templateParams["name"]="dettagli-cliente-template.php";
  }else{
    $templateParams["code_error"]= "Codice Cliente inesistente!";
  }

}


require './template/base-template.php';
?>
