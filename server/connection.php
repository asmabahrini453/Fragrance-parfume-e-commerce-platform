<?php 
//either u connect to tha DB or the connection will be killed
$dsn = 'mysql:host=localhost;dbname=php_project';
$username = 'root';
$password = '';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Couldn't connect to database: " . $e->getMessage());
}


?>