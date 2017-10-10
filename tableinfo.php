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


if (isset($_GET) || isset($_POST['table_name'])) {

if (isset($_GET['table_name'])) {
    $table = htmlspecialchars($_GET['table_name']);
} elseif (isset($_POST['table_name'])) {
    $table = htmlspecialchars($_POST['table_name']);
}

if (isset($_POST['change_name'])) {
        $name = htmlspecialchars($_POST['name']);
        $new_name = htmlspecialchars($_POST['new_name']);
        $type = htmlspecialchars($_POST['type']);
        $change_name = "ALTER TABLE $table CHANGE $name $new_name $type";
        $pdo->exec($change_name);
}

if (isset($_POST['change_type'])) {
    $name = htmlspecialchars($_POST['name']);
    $type = htmlspecialchars($_POST['new_type']);
    $change_type = "ALTER TABLE $table CHANGE $name $name $type";
    $pdo->exec($change_type);
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $del = "ALTER TABLE $table DROP COLUMN " . $_GET['id'];
        $pdo->exec($del);
    }

$sql = "DESCRIBE $table";
$statement = $pdo->prepare($sql);
$statement->execute();

$results = [];
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $results[] = $row;
}

}

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
        <a href="tablechange.php?id=<?= $row['Type']; ?>&table_name=<?= $table ?>&name=<?= $row['Field']; ?>&action=edit_type">Изменить тип</a>  
        <a href="tablechange.php?id=<?= $row['Field']; ?>&table_name=<?= $table ?>&type=<?= $row['Type']; ?>&action=edit_name">Изменить название</a>  
        <a href="tableinfo.php?id=<?= $row['Field']; ?>&table_name=<?= $table ?>&action=delete">Удалить</a>
    </td> 
</tr>
<?php } ?>
</table>

</body>
</html>
