<?php
session_start();

// Подключение к базе данных
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'project';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Проверка наличия данных в POST
if (!isset($_POST['custom-name'])) {
    exit('Please enter your name!');
}

// Получение данных из POST
$name = $_POST['custom-name'];
$phone = isset($_POST['custom-phone']) ? $_POST['custom-phone'] : '';

// Подготовка SQL запроса для вставки данных
if ($stmt = $con->prepare('INSERT INTO questions (name, phone) VALUES (?, ?)')) {
    $stmt->bind_param('ss', $name, $phone);
    if ($stmt->execute()) {
        echo 'Data inserted successfully!';
    } else {
        echo 'Failed to insert data.';
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement!';
}

$con->close();
?>
