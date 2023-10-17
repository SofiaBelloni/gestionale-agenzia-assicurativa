<?php
session_start();
require_once("db/database.php");
$dbh = new DatabaseHelper("127.0.0.1", "root", "", "agenzia_assicurativa", 3307);
?>
