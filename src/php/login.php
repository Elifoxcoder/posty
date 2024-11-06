<?php

include ('variables.php');

$username = !empty($_POST['username']) ? $_POST['username'] : die('Bitte gib einen Benutzernamen ein!');
$password = !empty($_POST['password']) ? $_POST['password'] : die('Bitte gib ein Passwort ein!');

$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindParam(":username", $username);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (password_verify($password, $row['password'])) {
            $userData = [
                'user_id' => $row['user_id']
            ];

            setForeverCookie('userData', json_encode($userData));
            echo 'success';
        } else {
            die('Falsches Passwort!');
        }
    }
} else {
    die('Nutzer nicht registriert!');
}

function getCookie($cookie_name)
{
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    } else {
        return null;
    }
}

function setForeverCookie($cookie_name, $cookie_value)
{
    // Ablaufdatum: 10 Jahre
    $cookie_expire = time() + (10 * 365 * 24 * 60 * 60);

    // Setze das Cookie
    setcookie($cookie_name, $cookie_value, $cookie_expire, '/');
}
