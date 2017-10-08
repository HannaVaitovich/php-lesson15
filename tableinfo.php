<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>PHP: Lesson 15</title>
    <style>
        table {
            margin-top: 20px;
            border-collapse: collapse;
        }
        td, th {
            border: 1px solid black;
            padding: 5px 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<a href="tablelist.php">Список таблиц</a>
<?php
error_reporting(E_ALL);

$host = 'localhost';    //127.0.0.1
$db = 'php-15-homework';
$user = 'root';
$password = "alex1983";

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);

if (!$pdo)
{
    die('Could not connect');
}

if (isset($_GET)) {
$table = htmlspecialchars($_GET['name']);

$sql = "DESCRIBE $table";
$statement = $pdo->prepare($sql);
$statement->execute();

$results = [];
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $results[] = $row;
}
}

//echo '<pre>';
//print_r($_GET);
//echo '</pre>';

?>


<table>
<tr>
    <th>Название поля</th>
    <th>Тип</th>
    <th>Редактирование</th>
</tr>
<?php foreach ($results as $row) { ?>
<tr>
    <td><?= $row['Field']; ?></td>
    <td><?= $row['Type']; ?></td>
    <td>
        <a href="tableinfo.php?id=<?= $row['Type']; ?>&action=edit_type">Изменить TYPE</a>  
        <a href="tableinfo.php?id=<?= $row['Field']; ?>&action=done_name">Изменить NAME</a>  
        <a href="tableinfo.php?id=<?= $row['Field']; ?>&action=delete">Удалить</a>
    </td> 
</tr>
<?php } ?>
</table>

</body>
</html>
