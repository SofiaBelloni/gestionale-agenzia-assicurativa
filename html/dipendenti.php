<?php
require_once 'bootstrap.php';

if(count($_POST) > 9){

  if($_POST["roleSelect-text"][0]=='I'){
    $dbh->addNewEmployee($_POST["CF"], $_POST["name"], $_POST["surname"], date("Y-m-d", strtotime($_POST["birthdate"])), $_POST["address"], $_POST["house_number"], $_POST["zip_code"], $_POST["telephone"], $_POST["sedeSelect-text"]);
    $templateParams["add_employee"] = "Nuovo impiegato registrato correttamente!";
  }
  else{
    $dbh->addNewFinancialAdvisor($_POST["CF"], $_POST["name"], $_POST["surname"], date("Y-m-d", strtotime($_POST["birthdate"])), $_POST["address"], $_POST["house_number"], $_POST["zip_code"], $_POST["telephone"], $_POST["sedeSelect-text"]);
    $templateParams["add_employee"] = "Nuovo consulente finanziario registrato correttamente!";
  }
}
$templateParams["name"]="dipendenti-template.php";
require './template/base-template.php';
?>
