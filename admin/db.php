<?php
$host = 'sql306.infinityfree.com';
$user = 'if0_41944557'; 
$pass = '3cJqrULg2Syxiuy';
$dbname = 'if0_41944557_portfolio_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>