<?php

$host = "localhost";
$username = "root";
$password = "";
$db_name = "kursusjwp";

$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
	echo "Koneksi Gagal!";
	exit();
}
