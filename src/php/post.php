<?php
include('./variables.php');

// Check if text is present
if (!isset($_POST['text']) || empty(trim($_POST['text']))) {
    echo 'Bitte einen Text eingeben.';
    exit;
}

// Form data
$text = trim($_POST['text']);
$user_id = 1; // Example: Logged-in user ID, normally from session or login

// Bild- und Medienverarbeitung
$imagePaths = [];
$targetDir = '../uploads/';

// Überprüfen, ob Dateien hochgeladen wurden
if (isset($_FILES['imgToUpload']) && is_array($_FILES['imgToUpload']['name'])) {
    foreach ($_FILES['imgToUpload']['name'] as $key => $mediaName) {
        if ($_FILES['imgToUpload']['error'][$key] == 0) {
            $rand = random_int(1000000, 9999999);
            $extension = pathinfo($mediaName, PATHINFO_EXTENSION);
            $mediaPath = $targetDir . $rand . '-' . basename($mediaName);

            if (move_uploaded_file($_FILES['imgToUpload']['tmp_name'][$key], $mediaPath)) {
                // Die Medientypen anhand der Erweiterung bestimmen
                if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $imagePaths[] = './uploads/' . $rand . '-' . basename($mediaName);
                } elseif (in_array(strtolower($extension), ['mp4', 'webm', 'ogg'])) {
                    $imagePaths[] = './uploads/' . $rand . '-' . basename($mediaName);
                } elseif (in_array(strtolower($extension), ['mp3', 'wav', 'ogg'])) {
                    $imagePaths[] = './uploads/' . $rand . '-' . basename($mediaName);
                } elseif (in_array(strtolower($extension), ['pdf'])) {
                    $imagePaths[] = './uploads/' . $rand . '-' . basename($mediaName);
                }
            } else {
                echo "Datei $mediaName konnte nicht hochgeladen werden.";
                exit;
            }
        }
    }
}

// Setze "none" für `images`, wenn kein Bild hochgeladen wurde
$imagePathsJson = empty($imagePaths) ? 'none' : json_encode($imagePaths);


try {
    // Insert into the database
    $stmt = $conn->prepare('INSERT INTO posts (poster, description, images, created_at) VALUES (:user_id, :description, :images, NOW())');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':description', $text);
    $stmt->bindParam(':images', $imagePathsJson);

    if ($stmt->execute()) {
        echo 'Post erfolgreich hinzugefügt. Images: ' . $imagePathsJson; // Debugging output
    } else {
        echo 'Fehler beim Hinzufügen des Posts.';
    }
} catch (PDOException $e) {
    echo 'Datenbankfehler: ' . $e->getMessage();
}
?>
