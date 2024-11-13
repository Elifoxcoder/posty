<?php
function getCookie($cookie_name)
{
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    } else {
        return null;
    }
}

include('php/variables.php');

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

        nav .title img,
        nav .title .symbol {
            border-radius: 10px;
            object-fit: cover;
            margin-right: 12px;
            background: darkgreen;
            color: #fff;
            font-size: large;
            padding: 10px;
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

        nav .title button i {
            color: #000;
        }

        nav .title button:hover {
            background: #eee;
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

        nav .input-section input:focus {
            /* -webkit-box-shadow: 
            5px 5px 15px 0px #FF8080, 
            -9px 5px 15px 0px #FFE488, 
            -7px -5px 15px 0px #8CFF85, 
            12px -5px 15px 0px #80C7FF, 
            12px 10px 15px 0px #E488FF, 
            -10px 10px 15px 0px #FF616B, 
            -10px -7px 27px 0px #8E5CFF, 
            0px 0px 15px 0px rgba(0, 0, 0, 0); */

            box-shadow:
                5px 5px 15px -10px #FF8080,
                -9px 5px 15px -10px #FFE488,
                -7px -5px 15px -10px #8CFF85,
                12px -5px 15px -10px #80C7FF,
                12px 10px 15px -10px #E488FF,
                -10px 10px 15px -10px #FF616B,
                -10px -7px 27px -10px #8E5CFF,
                0px 0px 15px -10px rgba(0, 0, 0, 0);


        }

        nav .input-section input::placeholder {
            color: #222;
        }

        nav .input-section {
            padding: 25px;
            position: relative;
            padding-bottom: 0;
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

        nav .navigation i {
            width: 20px;
            transition: 200ms;
            color: #aaa;
        }

        nav .navigation a.active {
            background: #ddd;
            color: #222;
        }

        nav .navigation a.active i {
            color: #222;
        }

        nav .navigation a:hover,
        nav .navigation a:hover i {
            color: #222;
        }

        .quick-settings {
            display: flex;
            flex-direction: column;
            padding: 25px;
        }

        .quick-settings span {
            font-size: 15px;
            color: #999;
            margin-bottom: 10px;
        }

        .quick-settings .tiles {
            display: flex;
            gap: 5px;
        }

        .quick-settings .tiles .tile {
            padding: 10px;
            background: #fff;
            border-radius: 10px;
            flex: 1;
            -webkit-box-shadow: 0px 0px 1px 1px rgba(197, 197, 197, 0.88);
            box-shadow: 0px 0px 1px 1px rgba(197, 197, 197, 0.88);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
        }

        .quick-settings .tile i,
        .quick-settings .tile p {
            color: #999;
        }

        .quick-settings .tile.active i,
        .quick-settings .tile.active p {
            color: #222;
        }

        .quick-settings .tile.active {
            -webkit-box-shadow: 0px 0px 1px 1px rgba(55, 55, 55, 0.88);
            box-shadow: 0px 0px 1px 1px rgba(55, 55, 55, 0.88);
            background: rgba(0, 0, 0, 0.1);
        }

        nav .profile {
            display: flex;
            padding: 25px;
            margin-top: auto;
            align-items: center;
            gap: 10px;
        }

        nav .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .open-settings-btn {
            margin-left: auto;
            background: transparent;
            border: 0;
            transition: 300ms;
            font-size: large;
            padding: 5px 10px;
            border-radius: 10px;
            color: #aaa;
            cursor: pointer;
        }

        .open-settings-btn:hover {
            background: #eee;
        }

        .posts {
            background: rgb(250, 250, 250);
            display: flex;
            flex-direction: column;
            align-items: center;
            width: calc(100vw - 350px);
            height: 100vh;
            padding: 25px;
            gap: 25px;
            overflow-y: scroll;
        }

        .post {
            max-width: 750px;
            width: 100%;
            background: #fff;
            -webkit-box-shadow: 0px 0px 1px 1px rgba(197, 197, 197, 0.88);
            box-shadow: 0px 0px 1px 1px rgba(197, 197, 197, 0.88);
            border-radius: 25px;
        }

        .post .profile {
            display: flex;
            padding: 25px;
            align-items: center;
            gap: 10px;
            padding-bottom: 0;
        }

        .post .profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .post .descr {
            padding: 25px;
            line-break: anywhere;
            word-break: break-all;
        }

        .post .img {
            padding: 25px;
            padding-top: 0;
        }

        .post .img img {
            border-radius: 25px;
            width: 100%;
            max-height: 500px;
            background: #222;
            object-fit: contain;
        }

        .post .actions {
            padding: 25px;
            padding-top: 0;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .post .actions button {
            background: transparent;
            border: 0;
            border-radius: 10px;
            flex: 1;
            cursor: pointer;
            color: #555;
            padding: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
            justify-content: center;
            transition: 300ms;
        }

        .post .actions button i {
            color: #555;
        }

        .post .actions button:hover {
            background: #ddd;
        }

        /* Sidebar collapsed state */
        nav.folded-in {
            overflow: hidden;
            min-width: 100px;
        }

        nav.folded-in .navigation a span,
        nav.folded-in .navigation .item span,
        nav.folded-in .input-section input,
        nav.folded-in .profile :not(img),
        nav.folded-in .tiles,
        nav.folded-in .quick-settings p,
        nav.folded-in .input-section input::placeholder,
        nav.folded-in .title h2,
        nav.folded-in .title>i {
            max-width: 0;
            opacity: 0;
            visibility: hidden;
            transition: max-width 0.3s ease, opacity 0.3s ease, visibility 0s 0.3s;
        }

        nav.folded-in .navigation i {
            width: max-content;
            margin: auto;
        }

        nav .navigation a span,
        nav .navigation .item span,
        nav .quick-settings p {
            max-width: 200px;
            /* Adjust this to the max width of the text */
            opacity: 1;
            visibility: visible;
            transition: max-width 0.3s ease, opacity 0.3s ease;
        }

        nav.folded-in .title>i {
            display: none;
        }

        nav.folded-in .item {
            gap: 0;
        }

        nav.folded-in .profile {
            gap: 0;
        }

        nav.folded-in .profile button {
            display: none;
        }

        nav.folded-in .title button i {
            transform: rotate(180deg);
        }

        nav.folded-in .title button {
            margin-left: auto;
            margin-right: auto;
        }

        .input-section .popout {
            position: absolute;
            left: 50%;
            /*background: #fff;*/
            border-radius: 0px 10px 10px 10px;
            padding: 10px;
            top: 70%;
            width: max-content;
            -webkit-box-shadow: 0px 0px 10px 1px rgba(197, 197, 197, 0.2);
            box-shadow: 0px 0px 10px 1px rgba(197, 197, 197, 0.2);
            max-width: 350px;
            backdrop-filter: blur(10px);
            display: none;
        }

        .spinner {
            animation: rotate 2s linear infinite;
            z-index: 2;
            width: 50px;
            height: 50px;
            stroke: #000;
        }

        .path {
            stroke: hsl(210, 70, 75);
            stroke-linecap: round;
            animation: dash 1.5s ease-in-out infinite;
        }

        @keyframes rotate {
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes dash {
            0% {
                stroke-dasharray: 1, 150;
                stroke-dashoffset: 0;
            }

            50% {
                stroke-dasharray: 90, 150;
                stroke-dashoffset: -35;
            }

            100% {
                stroke-dasharray: 90, 150;
                stroke-dashoffset: -124;
            }
        }

        @keyframes t {
            from {
                filter: blur(10px);
            }

            to {
                background-size: 150% 100%;
                filter: blur(0px);

            }
        }

        @keyframes b {
            from {
                filter: blur(10px);
            }

            to {
                background-position: -201% 0, 0 0;
                filter: blur(0px);
            }
        }

        .reveal {
            color: transparent;
            --g: no-repeat linear-gradient(#fff 0 0) 0 0;
            background: var(--g), var(--g);
            background-size: 0 100%;
            -webkit-background-clip: padding-box, text;
            background-clip: padding-box, text;
            -webkit-box-decoration-break: clone;
            box-decoration-break: clone;
            animation: t 1.2s 0s both, b 1.2s 0s both;
        }

        .popout hr {
            margin: 1em 0;
            border: 0;
            border-bottom: 1px solid #ccc;
        }

        .popout blockquote {
            margin-left: 0;
            padding: 0.5em 0 0.5em 2em;
            border-left: 3px solid rgb(211, 218, 234);
        }

        .popout li,
        .popout code {
            margin: 0.4em 0;
        }

        .popout p {
            margin: 0.9em 0;
        }

        .popout code {
            background: rgba(211, 218, 234, 0.25);
        }

        .popout pre>code {
            display: block;
            padding: 0.5em 4em;
        }

        .popout table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        .popout td {
            padding: 4px 8px;
        }

        .popout tr:nth-child(2n) {
            background: #f3f3f3;
        }

        .popout th {
            border-bottom: 1px solid #aaa;
        }

        .popout img {
            max-width: 96px;
        }


        .popout ul,
        .popout ol {
            margin-left: 15px;
        }

        .create-post {
            position: fixed;
            bottom: 50px;
            right: 50px;
            border-radius: 50px;
            background: #222;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            cursor: pointer;
            gap: 0;
            height: 50px;
            transition: .5s;
            transition-timing-function: cubic-bezier(0.785, 0.135, 0.150, 0.860);
            ;
        }

        .create-post:hover {
            gap: 10px;
            width: 144px;
        }

        .create-post p {
            text-overflow: clip;
            white-space: nowrap;
        }

        .create-post div {
            width: 0px;
            overflow: hidden;
        }

        .create-post:hover div {
            width: 80.05px;
        }

        .create-post p,
        i {
            color: #fff;
        }

        .create-post.active {
            width: var(--doc-inner-width);
            height: 100vh;
            bottom: 0px;
            right: 0px;
            border-radius: 0px;
        }

        .post-form {
            padding: 50px;
        }
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
            <input type="text" name="browse-with-alaris" id="browse-with-alaris" list="browse-with-alaris-datalist"
                placeholder="Mit Alaris AI dursuchen">
            <div class="popout" id="output">
            </div>
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
                <span><b id="heading-name">
                        <?= $username ?>
                    </b></span>
                <p>
                    <?= $email ?>
                </p>
            </div>
            <button class="open-settings-btn">
                <i class="fa-solid fa-gear"></i>
                <i class="fa-solid fa-paperclip"></i>
            </button>
        </div>
    </nav>
    <main>
        <form action="#" class="post-form">
            <h1>Post erstellen</h1>
            <textarea name="text" id="text" placeholder="Schreibe hier..."></textarea>
            <div class="media">
                <div class="left">
                    <i class="fa-solid fa-image"></i>
                    <i class="fa-solid fa-paperclip"></i>
                </div>
                <div class="right">
                    <i class="fa-solid fa-face-smile"></i>
                </div>
            </div>
        </form>
    </main>

    <datalist id="browse-with-alaris-datalist">
        <option value="Chat öffnen"></option>
        <option value="Chat erstellen"></option>
        <option value="Nachhilfe"></option>
        <option value="Freunde ansehen"></option>
        <option value="Post erstellen"></option>
        <option value="Posts öfnnen"></option>
    </datalist>
    <script type="importmap">
        {
          "imports": {
            "@google/generative-ai": "https://esm.run/@google/generative-ai"
          }
        }
      </script>
    <script type="module">

        let name = "<?= $username ?>";
        let alarisInput = document.getElementById("browse-with-alaris");

        import { GoogleGenerativeAI } from "@google/generative-ai";

        const genAI = new GoogleGenerativeAI("AIzaSyBLJfVi_k9J4rh17ilNVdJlswDWjTQktxs");

        async function run(promptText, retries = 0) {
            document.getElementById("output").innerHTML = `<svg class="spinner" viewBox="0 0 50 50">
  <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
</svg>`;

            try {
                const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
                const prompt = promptText;
                const result = await model.generateContent(prompt);
                const response = await result.response;
                const text = await response.text();

                if (text) {
                    document.getElementById("output").style.display = "block";
                    document.getElementById("output").classList.remove("reveal");
                    document.getElementById("output").innerHTML = ``;
                    // document.querySelector(".loading-spinner").classList.add("hidden");
                    // document.querySelector("form").classList.remove("hidden");
                    if (text) {
                        // document.querySelector(".loading-spinner").classList.add("hidden");
                        // document.querySelector("form").classList.remove("hidden");
                    }
                    if (text.includes('open chat')) {
                        window.open("https://chat.google.com", '_blank');
                    } else if (text.includes('open settings')) {
                        window.open("https://myaccount.google.com/", '_blank');
                    } else if (text.includes('not understand')) {
                        writer("Das habe ich nicht verstanden.");
                    } else if (text.includes('open posts')) {
                        window.open("https://facebook.com", '_blank');
                    } else if (text.includes('new post')) {
                        document.querySelector(".create-post").click();
                    } else if (text.includes("changeusername")) {
                        // Benutzername extrahieren
                        let username = text.match(/\((.*?)\)/)[1];

                        changeUsername(username);
                        writer("Okay, ich ändere deinen Namen.");
                        document.querySelector("#heading-name").innerHTML = username;
                        name = username;

                    } else {
                        writer(text);
                    }

                    document.getElementById("output").classList.add("reveal");

                    console.log(text);

                } else {
                    throw new Error("No response received from server");
                }
            } catch (error) {
                if (error.message.includes("Internal Server Error") && retries < 2) {
                    console.error("Internal server error encountered. Retrying...", error);
                    retries++;
                    await run(promptText, retries); // Retry the function call
                } else {
                    console.error("Error generating content:", error);
                    // Handle other errors here (e.g., display an error message to the user)
                }
            } finally {
                alarisInput.value = ""; // Clear the input field
            }
        }

        function changeUsername(username) {
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "php/change-username.php", true);
            xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhttp.send("username=" + username);
        }


        let form = document.querySelector("form");



        alarisInput.oninput = function () {
            if (alarisInput.value === "Chat öffnen") {
                location.href = "chat";
                alarisInput.value = "";
            } else if (alarisInput.value === "Chat erstellen") {
                location.href = "chat/create.php";
                alarisInput.value = "";
            } else if (alarisInput.value === "Nachhilfe") {
                location.href = "help";
                alarisInput.value = "";
            } else if (alarisInput.value === "Freunde ansehen") {
                location.href = "friends";
                alarisInput.value = "";
            } else if (alarisInput.value === "Post erstellen") {
                location.href = "./create.php";
                alarisInput.value = "";

            } else if (alarisInput.value === "Posts öffnen") {
                location.href = "./index.php";
                alarisInput.value = "";
            }
        };

        alarisInput.addEventListener("keydown", e => {
            let AlarisValue = alarisInput.value;
            if (event.key === 'Enter') {
                let prompt = "Du bist eine KI für den Einsatz in einer Schul-Webapp. Du heisst Alaris AI. Du basierst auf Gemini 1.5 Flash, aber du wurdest trainiert von Elias, der CEO dieser Webapp(Posty) Dein Input kommt meistens von Schülern die diese Webapp benutzen. Deine Aufgabe ist es, Befhele auszuführen oder Fragen zu beantworten. Falls du erkennst, dass der Benutzer etwas machen will(Zb posts öffnen, chat öffnen, etc) kannst du das tun. Falls du merkst, dass der Benutzer nur eine Frage hat, kannst du diese ganz normal beantworten aber nur wenn du nicht in der Frageantwort die Aktion erwähnst. Nach einer Antwort auf eine Frage, musst du aber noch nachfragen, ob der Schüler/in noch etwas machen will und ihm dann verschiedene Aktionen vorschlagen ohne die englische Aktion zu sagen. Hier sind die möglichen Befehle, falls du einen Befehl ausführen musst: open chat, open posts, open settings, changeusername(DER_NAME) oder not understand. Diese Aktionen sollst du immer genau so ausgeben, ohne etwas dazu zu sagen wie Bittesehr. Denk daran, dass ich deine Ausgabe so einfach wie möglich auswerten muss in meinem JS Code. Antworte immer auf deutsch, wenn jemand eine frage stellt, sonst bei einer aktion auf englisch. Hier sind noch einige Informationen: Schule in Wildegg, Brunegg, Holderbank und Möriken verteilt, zussamen Kreisschule Chestenberg. Der Nutzername des Schülers ist " + name + ". Dieser Input hat der Benutzer gegeben: " + AlarisValue;
                run(prompt);
            }
        });
    </script>
    <script>

        function toggleNavigation() {
            const navigation = document.querySelector('nav');
            navigation.classList.toggle('folded-in');
        }

        let i = 0;

        function writer(txt) {
            if (i < txt.length) {
                document.getElementById("output").innerHTML += `<i class="fa-solid fa-circle-xmark" onclick="document.querySelector('.popout').style.display = 'none';" style="cursor:pointer;"></i>`;//.charAt(i);
                document.getElementById("output").innerHTML += markdown(txt)//.charAt(i);
                i = i + txt.length;//i++;
                setTimeout(() => {
                    writer(txt);
                }, 5);
            } else {
                i = 0;
            }
        }

        function formatText(input) {
            // Replace text between double stars with bold
            input = input.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');

            // Replace text between three backticks with <code> tags
            input = input.replace(/```(.*?)```/g, '<code>$1</code>');

            // Find all sections that should become list items
            let listPart = input.match(/(\*(.*?)\s*)/g);

            if (listPart) {
                // Replace all single stars with <li> items in the list part
                let listItems = listPart.map(item => {
                    return item.replace(/\*(.*?)\s*/g, '<li>$1</li>');
                }).join(''); // Join all <li> elements

                // Replace the list part in the original string with the ordered list
                input = input.replace(listPart.join(''), '<ol>' + listItems + '</ol>');
            }

            return input;
        }
    </script>
</body>

</html>