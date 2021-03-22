<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "loja1";

$con = new mysqli($hostname, $username, $password, $databaseName);

if ($con->connect_error) {
    die("Falha na conexão: " . $con->connect_error);
}
