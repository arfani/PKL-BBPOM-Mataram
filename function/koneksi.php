<?php
$server = "localhost";
$user = "bbpo_admin";
$pass = "asdfasdf";
$database = "bbpo_pkl";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}
