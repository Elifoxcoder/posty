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

$name = $user['username'];

if (empty($userData)) {
    header('Location: ../login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posty | Kommunikation, Vernetzen, Sozialisieren</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script>
        document.querySelectorAll("input").forEach(function (textarea) {
            textarea.style.height = textarea.scrollHeight + "px";
            textarea.style.overflowY = "hidden";

            textarea.addEventListener("input", function () {
                this.style.height = "auto";
                this.style.height = this.scrollHeight + "px";
            });
        });
    </script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@40,400,0,0" />

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", Arial, Helvetica, sans-serif;
        }

        body {
            color: #f1f1f1;
            padding-top: 100px;
            background: linear-gradient(to right, #252530, #2a1a2c);
        }

        .container {
            display: flex;
            flex-direction: column;
        }

        .container.header {
            flex-direction: column;
            width: 100%;
            gap: 100px;
            padding: 100px;
            height: 100%;
            align-items: center;
        }

        .container.header img {
            width: 600px;
        }

        .col {
            display: flex;
            flex-direction: column;
        }

        .row {
            display: flex;
            flex-direction: row;
        }

        .container.header .col {
            display: flex;
            font-size: 2em;
            text-align: center;
        }

        h1 {
            font-size: 2em;
        }

        h2 {
            font-size: 1.2em;
        }

        nav {
            width: calc(100vw + 10px);
            height: calc(100px + 10px);
            position: fixed;
            top: -10px;
            display: flex;
            padding: 10px;
            padding-top: 20px;
            padding-left: 20px;
            left: -10px;
        }

        nav a {
            z-index: 1001;
            position: relative;
            color: #fff;
            filter: blur(0);
        }

        nav .bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            filter: blur(1px);
            z-index: 1000;
        }

        form input {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 0;
            border-radius: 100px;
            padding: 30px 70px;
            margin-top: 30px;
            color: #fff;
            outline: 0;
            width: 100%;
            font-size: 32px;
        }

        button {
            background: transparent;
            border: 1px solid #fff;
            border-radius: 20px;
            outline: 0;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
        }

        .input.row {
            gap: 10px;
        }

        .input.row :not(button) {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .input.row :nth-child(2) {
            width: min-content;
            border: 0px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 0;
            border-radius: 100px;
            padding: 30px 70px;
            margin-top: 30px;
            color: #fff;
            outline: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 32px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .hidden {
            transition: 300ms;
            height: 0px;
            scale: 0;
            transform: translateY(-100px);
        }

        form {
            transition: all 300ms;
        }

        #posrel {
            position: relative;
        }

        .loading-spinner {
            position: absolute;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
            transition: 0ms;
        }

        .loading-spinner img {
            max-width: 100px;
        }

        #output {
            background: transparent;
            outline: 0;
            border: 0;
            resize: none;
            margin-top: 50px;
            max-width: 846.18px;
            overflow-wrap: break-word;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <!-- <nav>
        <div class="bg">

        </div>
        <a href="# ">Start</a>
        <a href="# ">Start</a>
        <a href="# ">Start</a>
    </nav> -->
    <div class="container header">
        <div class="col" id="posrel">
            <h1 id="heading-name">Wilkommen zurück,
                <?= $name ?>
            </h1>
            <form action="#" autocomplete="off">
                <div class="row input">
                    <input type="text" name="fast-select" id="fast-select" placeholder="Wie kann ich dir heute helfen?">
                    <button type="submit" name="submit" id="submit">Senden<span class="material-symbols-rounded">
                            send
                        </span></button>
                </div>
                <!-- <button id="btnGiveCommand" type="button">Sprechen</button> -->
            </form>
            <div name="output" id="output" readonly></div>
            <div class="loading-spinner hidden">
                <img src="../images/loading.gif" alt="">
            </div>
        </div>
    </div>

    <script type="importmap">
        {
          "imports": {
            "@google/generative-ai": "https://esm.run/@google/generative-ai"
          }
        }
      </script>


    <script type="module">


        import { GoogleGenerativeAI } from "@google/generative-ai";

        const genAI = new GoogleGenerativeAI("AIzaSyBLJfVi_k9J4rh17ilNVdJlswDWjTQktxs");

        async function run(promptText, retries = 0) {
            document.getElementById("output").innerHTML = "";

            try {
                const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
                const prompt = promptText;
                const result = await model.generateContent(prompt);
                const response = await result.response;
                const text = await response.text();

                if (text) {
                    document.querySelector(".loading-spinner").classList.add("hidden");
                    document.querySelector("form").classList.remove("hidden");
                    if (text) {
                        document.querySelector(".loading-spinner").classList.add("hidden");
                        document.querySelector("form").classList.remove("hidden");
                    }
                    if (text.includes('open chat')) {
                        window.open("https://chat.google.com", '_blank');
                    } else if (text.includes('open settings')) {
                        window.open("https://myaccount.google.com/", '_blank');
                    } else if (text.includes('not understand')) {
                        writer("Das habe ich nicht verstanden.");
                    } else if (text.includes('open posts')) {
                        window.open("https://facebook.com", '_blank');
                    } else if (text.includes("changeusername")) {
                        // Benutzername extrahieren
                        let username = text.match(/\((.*?)\)/)[1];

                        changeUsername(username);
                        writer("Okay, ich ändere deinen Namen.");
                        document.querySelector("#heading-name").innerHTML = "Wilkommen zurück, " + username;

                    } else {
                        writer(text);
                    }


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
                document.querySelector("form input").value = ""; // Clear the input field
            }
        }

        // var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
        // var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

        // var grammar = '#JSGF V1.0;'

        // var recognition = new SpeechRecognition();
        // var speechRecognitionList = new SpeechGrammarList();
        // speechRecognitionList.addFromString(grammar, 1);
        // recognition.grammars = speechRecognitionList;
        // recognition.lang = 'de-ch';
        // recognition.interimResults = false;

        // recognition.onresult = function (event) {
        //     var last = event.results.length - 1;
        //     var command = event.results[last][0].transcript;

        //     document.querySelector("form input").value = command;
        //     run(command);
        // };

        // recognition.onspeechend = function () {
        //     recognition.stop();
        // };


        // document.querySelector('#btnGiveCommand').addEventListener('click', function () {
        //     recognition.start();

        // });

        function changeUsername(username) {
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../php/change-username.php", true);
            xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhttp.send("username=" + username);
        }


        let form = document.querySelector("form");

        form.addEventListener("submit", e => {
            e.preventDefault();
            form.classList.add("hidden");
            document.querySelector(".loading-spinner").classList.remove("hidden");
            let value = document.querySelector("form input").value;
            let prompt = "Du bist eine KI für den Einsatz in einer Schul-Webapp. Dein Input kommt meistens von Schülern die diese Webapp benutzen. Deine Aufgabe ist es, Befhele auszuführen oder Fragen zu beantworten. Falls du erkennst, dass der Benutzer etwas machen will(Zb posts öffnen, chat öffnen, etc) kannst du das tun. Falls du merkst, dass der Benutzer nur eine Frage hat, kannst du diese ganz normal beantworten aber nur wenn du nicht in der Frageantwort die Aktion erwähnst. Nach einer Antwort auf eine Frage, musst du aber noch nachfragen, ob der Schüler/in noch etwas machen will und ihm dann verschiedene Aktionen vorschlagen ohne die englische Aktion zu sagen. Hier sind die möglichen Befehle, falls du einen Befehl ausführen musst: open chat, open posts, open settings, changeusername(DER_NAME) oder not understand. Diese Aktionen sollst du immer genau so ausgeben, ohne etwas dazu zu sagen wie Bittesehr. Denk daran, dass ich deine Ausgabe so einfach wie möglich auswerten muss in meinem JS Code. Antworte immer auf deutsch, wenn jemand eine frage stellt, sonst bei einer aktion auf englisch. Hier sind noch einige Informationen: Schule in Wildegg, Brunegg, Holderbank und Möriken verteilt, zussamen Kreisschule Chestenberg. Der Nutzername des Schülers ist <?= $name ?>. Dieser Input hat der Benutzer gegeben: " + value;
            run(prompt);
        });
    </script>

    <script>
        let i = 0;

        function writer(txt) {
            if (i < txt.length) {
                document.getElementById("output").innerHTML += txt.charAt(i);
                i++;
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