<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>PHP: Lesson 15</title>
</head>
<body>

<?php

$host = 'localhost';    //127.0.0.1
$db = 'php-15-homework';
$user = 'root';
$password = "alex1983";


$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
if (!$pdo)
{
    die('Could not connect');
}

$table_name = 'friends';

$sql = "CREATE TABLE IF NOT EXISTS $table_name (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`last_name` varchar(35) NOT NULL,
`first_name` varchar(20) NOT NULL,
`phone` int(11) NOT NULL,
`address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";


$statement = $pdo->prepare($sql);
$statement->execute();
echo 'Table ' . $table_name . ' has been created'.'<br/>';


?>

<a href="tablelist.php">Список таблиц</a>

</body>
</html>