<?php
include("variables.php");

function getCookie($cookie_name)
{
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    } else {
        return null;
    }
}

$postId = getSecondPart($_POST['postId']);

if (empty($_POST['postId'])) {
    die("400 - Bad Request. Bitte frage nur mit einer postId an.");
}

$userData = getCookie('userData');
$userData = json_decode($userData);

$userId = $userData->user_id;

try {
    $stmt = $conn->prepare('SELECT * FROM posts WHERE id = :post_id');
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT); // Setze den Typ als INT, falls postId eine Zahl ist
    $stmt->execute();
    $post = $stmt->fetch();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


if ($post['poster'] == $userId) {
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = :post_id");
    $stmt->bindParam(":post_id", $postId);
    if ($stmt->execute()) {
        echo "success";
    }
} else {
    die("403 - Not allowed. Du bist nicht der Eigentümer dieses Posts.");
}

function getSecondPart($string)
{
    $parts = explode('-', $string);

    // Prüfe, ob der zweite Teil existiert
    if (isset($parts[1])) {
        return $parts[1];
    } else {
        return null; // Falls der zweite Teil nicht existiert
    }
}

