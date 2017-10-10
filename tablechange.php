<?php
$host = 'localhost';
$db = 'vaitovich';
$user = 'vaitovich';
$password = "neto1203";
//$host = 'localhost';    //127.0.0.1
//$db = 'php-15-homework';
//$user = 'root';
//$password = "alex1983";

$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);

if (!$pdo)
{
    die('Could not connect');
}
//echo '<pre>';
//print_r($_GET);
//echo '</pre>';

if (!empty($_GET['id'])) {

    if (isset($_GET['action']) && $_GET['action'] == 'edit_name') {
        echo '<form method="post" action="tableinfo.php">
                <input type="hidden" name="table_name" value="' . $_GET['table_name'] . '">
                <input type="hidden" name="name" value="' . $_GET['id'] . '">
                <input type="hidden" name="type" value="' . $_GET['type'] . '">
                <input name="new_name" value="' . $_GET['id'] . '">
                <input type="submit" name="change_name" value="Изменить название поля ' . $_GET['id'] . '">
            </form>';
}

    if (isset($_GET['action']) && $_GET['action'] == 'edit_type') {
        echo '<form method="post" action="tableinfo.php">
                <input type="hidden" name="table_name" value="' . $_GET['table_name'] . '">
                <input type="hidden" name="name" value="' . $_GET['name'] . '">
                <input type="hidden" name="type" value="' . $_GET['id'] . '">
                <input name="new_type" value="' . $_GET['id'] . '">
                <input type="submit" name="change_type" value="Изменить тип поля ' . $_GET['name'] . '">
            </form>';
}

}