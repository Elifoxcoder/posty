<?php

function getCookie($cookie_name)
{
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    } else {
        return null;
    }
}


include 'variables.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];

    if (empty($username)) {
        exit('Benutzername darf nicht leer sein.');
    }

    try {
        $userData = getCookie('userData');
        $userData = json_decode($userData);

        // Überprüfen, ob die Decodierung erfolgreich war
        if (json_last_error() !== JSON_ERROR_NONE || empty($userData->user_id)) {
            exit('Ungültige Benutzerdaten.');
        }

        // Benutzername validieren
        if (strlen($username) < 3 || strlen($username) > 20) {
            exit('Benutzername muss zwischen 3 und 20 Zeichen lang sein.');
        }

        $stmt = $conn->prepare('UPDATE `users` SET username = :username WHERE user_id = :user_id');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':user_id', $userData->user_id);

        if ($stmt->execute()) {
            echo 'Benutzername erfolgreich aktualisiert.';
        } else {
            echo 'Fehler beim Aktualisieren des Benutzernamens.';
        }
    } catch (PDOException $e) {
        die('Fehler: ' . $e->getMessage());
    }
}
