<?php
// Include fișierele necesare pentru interfețele și clasele utilizate
require_once "./app/DatabaseConnectionInterface.php";
require_once "./app/AngajatRepositoryInterface.php";
require_once "./app/DatabaseConnection.php";
require_once "./app/AngajatRepository.php";

// Obține configurația bazei de date (DSN, username, parolă)
[$dsn, $username, $password] = require_once './config.php';

// Inițializează conexiunea la baza de date
$databaseConnection = new DatabaseConnection($dsn, $username, $password);
?>
