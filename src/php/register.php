<?php

include 'variables.php';

$name = !empty($_POST['name']) ? $_POST['name'] : die('Bitte gib einen Namen ein!');
$email = !empty($_POST['email']) ? $_POST['email'] : die('Bitte gib eine E-Mail-Adresse ein!');
$password = !empty($_POST['password']) ? $_POST['password'] : die('Bitte gib ein Passwort ein!');

// E-Mail validieren
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Ungültige E-Mail-Adresse!');
}

// Passwortanforderungen
if (strlen($password) < 8) {
    die('Passwort muss mindestens 8 Zeichen lang sein!');
}
if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
    die('Passwort muss Sonderzeichen enthalten!');
}

// Benutzername aus der E-Mail extrahieren
$username = strstr($email, '@', true);

// Überprüfen, ob der Benutzer bereits existiert
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    die('E-Mail bereits vergeben!');
} else {
    // Passwort hashen
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Benutzer in die Datenbank einfügen
    $sql = "INSERT INTO users (email, password, username, name) VALUES (:email, :password, :username, :name)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':name', $name);

    if ($stmt->execute()) {
        // Benutzer-ID des neu erstellten Benutzers abrufen
        $userId = $conn->lastInsertId(); // Die ID des letzten eingefügten Datensatzes

        // Benutzerdaten für das Cookie vorbereiten
        $userData = [
            'user_id' => $userId
        ];

        setForeverCookie('userData', json_encode($userData));
        echo 'success';
    } else {
        die('Fehler bei der Registrierung');
    }
}

function setForeverCookie($cookie_name, $cookie_value)
{
    // Ablaufdatum: 10 Jahre
    $cookie_expire = time() + 10 * 365 * 24 * 60 * 60;

    // Setze das Cookie mit sicherer Konfiguration
    setcookie($cookie_name, $cookie_value, $cookie_expire, '/', '', true, true);
}

function getCookie($cookie_name)
{
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    } else {
        return null;
    }
}
