<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>PHP: Lesson 15</title>
</head>
<body>

<h1>Список таблиц</h1>

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

$sql = "SHOW TABLES";
$statement = $pdo->prepare($sql);
$statement->execute();

$results = [];
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
	foreach($row as $key => $value) {
		$result[] = $value;
	}
	echo '<a href="tableinfo.php?table_name=' . $value . '">' . $value . '</a><br>';
}

?>

</body>
</html>
