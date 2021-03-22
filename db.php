<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "loja1";

$con = mysqli_connect($hostname, $username, $password, $databaseName);
