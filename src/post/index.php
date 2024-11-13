<?php
function getCookie($cookie_name)
{
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    } else {
        return null;
    }
}

include('../php/variables.php');

$userData = getCookie('userData');
$userData = json_decode($userData);

$userId = $userData->user_id;

$stmt = $conn->prepare('SELECT * FROM users WHERE user_id = :user_id');
$stmt->bindParam(':user_id', $userId);
$stmt->execute();
$user = $stmt->fetch();

$username = $user['username'];
$email = $user['email'];

if (empty($userData)) {
    header('Location: login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posty</title>
    <script src="https://kit.fontawesome.com/08ca15d3fb.js" crossorigin="anonymous"></script>
    <script src="drawdown.js"></script>
    <script>
        function updateInnerWidth() {
            document.documentElement.style.setProperty('--doc-inner-width', `${window.innerWidth}px`);
        }

        // Set the variable initially
        updateInnerWidth();

        // Update the variable whenever the window is resized
        window.addEventListener('resize', updateInnerWidth);
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
            color: #222;
            transition: 300ms;
        }

        body {
            display: flex;
        }

        nav {
            background-color: rgb(250, 250, 250);
            height: 100vh;
            min-width: 350px;
            max-width: 350px;
            border-right: 1px solid #ccc;
            display: flex;
            flex-direction: column;
        }

        nav .title {
            display: flex;
            align-items: center;
            padding: 25px;
            padding-bottom: 0;
        }

        nav .title button {
            margin-left: auto;
            background: transparent;
            border: 0;
            transition: 300ms;
            font-size: large;
            padding: 5px 10px;
            border-radius: 10px;
            color: #000;
            cursor: pointer;
        }

        nav .input-section input {
            -webkit-box-shadow: 0px 0px 1px 1px rgba(197, 197, 197, 0.88);
            box-shadow: 0px 0px 1px 1px rgba(197, 197, 197, 0.88);
            border: 0;
            border-radius: 10px;
            width: 100%;
            padding: 10px;
            background: #fff;
            font-weight: 549;
            outline: 0;
        }

        nav .navigation {
            display: flex;
            flex-direction: column;
            padding: 25px;
            padding-bottom: 0;
        }

        nav .navigation a {
            text-decoration: none;
            border-radius: 10px;
            padding: 10px 15px;
            display: flex;
            gap: 10px;
            align-items: center;
            color: #aaa;
            transition: 200ms;
        }

        nav .navigation a.active {
            background: #ddd;
            color: #222;
        }

        .profile {
            display: flex;
            padding: 25px;
            margin-top: auto;
            align-items: center;
            gap: 10px;
        }

        .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .dark-overlay {
            position: fixed;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.4);
            width: 100vw;
            height: 100vh;
            opacity: 0;
        }

        .dark-overlay-2 {
            position: fixed;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.6);
            width: 100vw;
            height: 100vh;
            opacity: 0;
           }

        /* Additional styles can be added here */
    </style>
</head>

<body>
    <nav>
        <div class="title">
            <i class="fa-solid fa-paper-plane symbol"></i>
            <h2>Posty</h2>
            <button class="toggle-sidebar-btn" onclick="toggleNavigation()">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
        </div>
        <div class="input-section">
            <input type="text" name="browse-with-alaris" id="browse-with-alaris" placeholder="Mit Alaris AI dursuchen">
        </div>
        <div class="navigation">
            <a href="#" class="item active"><i class="fa-solid fa-newspaper"></i><span>Posts</span></a>
            <a href="#" class="item"><i class="fa-solid fa-message"></i><span>Chat</span></a>
            <a href="#" class="item"><i class="fa-solid fa-handshake-angle"></i><span>Nachhilfe</span></a>
            <a href="#" class="item"><i class="fa-solid fa-user-group"></i><span>Freunde</span></a>
        </div>
        <div class="quick-settings">
            <span>Anzeige</span>
            <div class="tiles">
                <div class="tile active">
                    <i class="fa-solid fa-sun"></i>
                    <p>Light</p>
                </div>
                <div class="tile">
                    <i class="fa-solid fa-moon"></i>
                    <p>Dark</p>
                </div>
            </div>
        </div>
        <div class="profile">
            <img src="<?= $pfp ?>" alt="#">
            <div class="col">
                <span><b id="heading-name"><?= $username ?></b></span>
                <p><?= $email ?></p>
            </div>
            <button class="open-settings-btn">
                <i class="fa-solid fa-gear"></i>
            </button>
        </div>
    </nav>
    <main>
        <div class="posts">
            <!-- Post content has been removed -->
        </div>
    </main>
    <div class="dark-overlay"></div>
    <div class="dark-overlay-2"></div>

    <script>
        function toggleNavigation() {
            const navigation = document.querySelector('nav');
            navigation.classList.toggle('folded-in');
        }

        document.addEventListener("keydown", (e) => {
            if (e.key == "k") {
                toggleNavigation();
            }
        });
    </script>
</body>

</html>