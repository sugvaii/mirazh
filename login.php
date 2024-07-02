<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем reCAPTCHA
    $recaptcha_secret = 'ваш_secret_key'; // Замените на ваш секретный ключ reCAPTCHA
    $recaptcha_response = $_POST['g-recaptcha-response'];

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $result = json_decode($result);

    if ($result->success) {
        // reCAPTCHA успешно пройдена, выполняем авторизацию

        // Получаем данные из формы
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Добавьте здесь вашу логику проверки логина и пароля
        // Например, если используете базу данных:
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'project';

        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if (mysqli_connect_errno()) {
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }

        // Здесь должна быть ваша проверка логина и пароля
        // Примерно так:
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Авторизация успешна
                $_SESSION['username'] = $username;
                header('Location: Personal_Area.php'); // Перенаправляем на персональную страницу
                exit();
            } else {
                echo 'Неправильный логин или пароль';
            }
        } else {
            echo 'Пользователь с таким логином не найден';
        }

        $stmt->close();
        $con->close();

    } else {
        // reCAPTCHA не пройдена, обработка ошибки
        echo 'reCAPTCHA не пройдена. Пожалуйста, повторите попытку.';
    }
}
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

// Проверяем, что данные были отправлены из формы
if (!isset($_POST['username'], $_POST['password'])) {
    exit('Please complete the login form!');
}
if (!preg_match("/^[a-zA-Z0-9_\-@.]+$/", $_POST['username'])) {
    echo '<script>alert("Invalid characters in username!");</script>';
    exit();
}
// Подготавливаем SQL запрос для выборки пользователя по имени (логину)
if ($stmt = $con->prepare('SELECT id, password FROM client WHERE name = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    // Проверяем, найден ли пользователь с таким именем (логином)
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();

        // Проверяем соответствие введенного пароля и хеша пароля из базы данных
        if (password_verify($_POST['password'], $password)) {
            // Пароль верный, устанавливаем сессию и перенаправляем на личный кабинет
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $_POST['username'];
            header('Location: Personal_Area.php');
            exit();
        } else {
            // Неверный пароль
            echo 'Неверное имя пользователя или пароль!';
        }
    } else {
        // Пользователь с таким именем (логином) не найден
        echo 'Неверное имя пользователя или пароль!';
    }

    $stmt->close();
} else {
    // Ошибка подготовки запроса
    echo 'Could not prepare statement!';
}

$con->close();
?>
