<?php
session_start();

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'project';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['surname'], $_POST['name'], $_POST['phone'], $_POST['password'])) {
    exit('Please complete the registration form!');
}

if (empty($_POST['surname']) || empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['password'])) {
    exit('Please complete the registration form');
}
if (!preg_match("/^[a-zA-Zа-яА-Я]+$/u", $_POST['surname'])) {
    echo '<script>alert("Invalid characters in surname!");</script>';
    exit();
}

if (!preg_match("/^[a-zA-Zа-яА-Я]+$/u", $_POST['name'])) {
    echo '<script>alert("Invalid characters in name!");</script>';
    exit();
}



if ($stmt = $con->prepare('SELECT id FROM client WHERE phone = ?')) {
    $stmt->bind_param('s', $_POST['phone']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'Phone number exists, please choose another!';
    } else {
        if ($stmt = $con->prepare('INSERT INTO client (surname, name, patronymic, phone, email, password) VALUES (?, ?, ?, ?, ?, ?)')) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('ssssss', $_POST['surname'], $_POST['name'], $_POST['patronymic'], $_POST['phone'], $_POST['email'], $password);
            $stmt->execute();

            $_SESSION['surname'] = $_POST['surname'];
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['patronymic'] = $_POST['patronymic'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['email'] = $_POST['email'];

            // Перенаправляем на Personal_Area.php после успешной регистрации
            header('Location: Personal_Area.php');
            exit();
        } else {
            echo 'Could not prepare statement!';
        }
    }
    $stmt->close();
} else {
    echo 'Could not prepare statement!';
}
$con->close();
?>
