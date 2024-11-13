<?php
include('./variables.php');

function getCookie($cookie_name)
{
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    } else {
        return null;
    }
}

$userData = getCookie('userData');
$userData = json_decode($userData);

$user_id = $userData->user_id;

// Abrufen der Posts
$stmt = $conn->prepare('SELECT * FROM posts ORDER BY created_at DESC');
$stmt->execute();

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch()) {
        $profile_pic = 'https://images.pexels.com/photos/2876486/pexels-photo-2876486.png?cs=srgb&dl=pexels-dshanp-2876486.jpg&fm=jpg';
        $posted_on = $row['created_at'];
        $description = $row['description'];

        // Abruf des Benutzers zur jeweiligen Post
        $stmt2 = $conn->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $stmt2->bindParam(':user_id', $row['poster']); // Benutze 'poster', um den Benutzer zu identifizieren
        $stmt2->execute();

        if ($user = $stmt2->fetch()) {
            $name = $user['name'];
            $profile_pic = $user['pfp'];
        } else {
            $name = 'Unknown';
        }

        // Hier die Medien verarbeiten
        $mediaItems = json_decode($row['images']);
        $poster = $row['poster'];
        $postId = $row['id'];

        // Überprüfen, ob mediaItems existiert und ein Array ist
        if ($mediaItems === null || $mediaItems === 'none') {
            $mediaHtml = '';
        } else {
            // Sicherstellen, dass mediaItems ein Array ist
            $mediaItems = (array)$mediaItems; 
            $mediaHtml = "<div class='media-container'>";
            $firstMedia = true;

            foreach ($mediaItems as $media) {
                $mediaType = pathinfo($media, PATHINFO_EXTENSION);

                if (in_array($mediaType, ['jpg', 'jpeg', 'png', 'gif'])) {
                    if ($firstMedia) {
                        $mediaHtml .= "<img src='$media' class='main-media' alt='image'>";
                        $firstMedia = false;
                    } else {
                        $mediaHtml .= "<img src='$media' class='small-media' alt='image'>";
                    }
                } elseif (in_array($mediaType, ['mp4', 'webm', 'ogg'])) {
                    if ($firstMedia) {
                        $mediaHtml .= "<video class='main-media' controls><source src='$media' type='video/$mediaType'>Ihr Browser unterstützt kein HTML5-Video.</video>";
                        $firstMedia = false;
                    } else {
                        $mediaHtml .= "<video class='small-media' controls><source src='$media' type='video/$mediaType'>Ihr Browser unterstützt kein HTML5-Video.</video>";
                    }
                } elseif (in_array($mediaType, ['mp3', 'wav', 'ogg'])) {
                    if ($firstMedia) {
                        $mediaHtml .= "<audio class='main-media' controls><source src='$media' type='audio/$mediaType'>Ihr Browser unterstützt kein Audio-Tag.</audio>";
                        $firstMedia = false;
                    } else {
                        $mediaHtml .= "<audio class='small-media' controls><source src='$media' type='audio/$mediaType'>Ihr Browser unterstützt kein Audio-Tag.</audio>";
                    }
                } elseif ($mediaType === 'pdf') {
                    if ($firstMedia) {
                        $mediaHtml .= "<embed src='$media' class='main-media' type='application/pdf' width='100%' height='500px' />";
                        $firstMedia = false;
                    } else {
                        $mediaHtml .= "<embed src='$media' class='small-media' type='application/pdf' width='100px' height='100px' />";
                    }
                }
            }
            $mediaHtml .= "</div>"; // Schließen des Containers
        }

        echo "<div class='post' id='post-$postId-$poster'>
                  <div class='profile'>
                      <img src='$profile_pic' alt=''>
                      <div class='col'>
                          <span><b>$name</b></span>
                          <p>$posted_on</p>
                      </div>
                  </div>
                  <div class='descr'>
                      <p>$description</p>
                  </div>
                  <div class='img'>$mediaHtml</div>
                  <div class='actions'>
                      <button><i class='fa-regular fa-heart'></i> Like</button>
                      <button><i class='fa-solid fa-message'></i> Kommentare</button>
                      <button><i class='fa-solid fa-plus'></i> Merken</button>
                      <button><i class='fa-solid fa-share'></i> Teilen</button>
                  </div>
              </div>";
    }
} else {
    echo 'Keine Posts gefunden.';
}
