<?php
function getCookie($cookie_name)
{
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    } else {
        return null;
    }
}

include ('../../php/variables.php');

$userData = getCookie(('userData'));
$userData = json_decode($userData);

$username = $userData->username;
$password = $userData->password;
$name = $userData->name;
$userId = $userData->user_id;
$email = $userData->email;

$names = explode(' ', $name);
$fname = $names[0];

if (empty($userData)) {
    header('Location: ../login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/08ca15d3fb.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posty</title>
    <style>
        :root {
            --purple: rgb(123, 31, 162);
            --violet: rgb(103, 58, 183);
            --pink: rgb(244, 143, 177);
        }

        @keyframes background-pan {
            from {
                background-position: 0% center;
            }

            to {
                background-position: -200% center;
            }
        }

        @keyframes scale {

            from,
            to {
                transform: scale(0);
            }

            50% {
                transform: scale(1);
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(180deg);
            }
        }


        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            box-sizing: border-box;
            height: max-content;
        }

        body {
            height: 100vh;
            background: #f0f0f0f0;
        }

        .navigation {
            height: 100%;
        }

        .row {
            display: flex;
            flex-direction: row;
        }

        .hero {
            height: 100%;
            width: 100%;
        }

        .navigation {
            display: flex;
            padding-top: 20px;
            flex-direction: column;
        }

        .menu-item {
            display: flex;
            gap: 12px;
            padding: 12px 24px;
            margin-left: 20px;
            padding-right: 50px;
            height: max-content;
            text-decoration: none;
            color: #344767;
            font-size: 1.2em;
            align-items: center;
            border-radius: 10px;
        }

        .menu-item i {
            padding: 12px;
            background: #fff;
            border-radius: 12px;
            width: 50px;
            text-align: center;
            transition: color 300ms;
        }

        .menu-item.active i {
            background: #344767;
            color: #fff;
        }

        .menu-item.active {
            background: #fff;
        }

        .content-outer {
            height: 100%;
            display: flex;
            flex: 1;
            padding: 34px;
            overflow-y: scroll;
        }

        .heading {
            width: 100%;
            margin-bottom: 10px;
        }

        .content-inner {
            flex: 1;
            height: 100%;
            display: flex;
            width: 100%;
            flex-direction: column;
            background: #fff;
            border-radius: 15px;
            padding: 15px;
        }

        .card {
            height: 160px;
            min-width: 350px;
        }

        .active-friends {
            display: flex;
            gap: 10px;
            max-height: 100%;
            overflow-y: scroll;
            flex-direction: column;
        }

        .active-friends::-webkit-scrollbar {
            position: absolute;
            right: -20px;
        }

        .active-friends:hover::-webkit-scrollbar {
            position: absolute;
            right: 20px;
        }

        .active-friends ul {
            display: flex;
            flex-direction: column;
        }

        .active-friends ul a {
            text-decoration: none;
            color: #000;
            display: flex;
            gap: 10px;
            align-items: center;
            border-top: 1px solid #ccc;
            padding: 15px 0px;
        }

        .active-friends ul a:first-of-type {
            border-top: 0px;
            padding-top: 5px;
        }

        .active-friends ul a img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 25px;
        }

        .active-friends .online {
            background: green;
            padding: 3px 5px;
            border-radius: 5px;
            color: #fff;
            width: max-content;
            margin-top: 2px;

        }

        .active-friends .offline {
            background: darkred;
            padding: 3px 5px;
            border-radius: 5px;
            color: #fff;
            width: max-content;
            margin-top: 2px;
        }


        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        button {
            background-color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px;
            cursor: pointer;
            transition: box-shadow 0.2s ease, background-color 0.2s ease;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-left: 10px;
        }

        button:hover {
            background-color: #e9ecef;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        #search-chats {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .chats {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 15px;
        }

        .chats .row {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.2s ease;
        }

        .chats .row:hover {
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
        }

        .chats img {
            border-radius: 10px;
            margin-right: 15px;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .chats .col {
            display: flex;
            flex-direction: column;
        }

        .content-inner>.col>.row{
            display: flex;
            align-items: center;
        }

        .chats .col span {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .chats .col p {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        #make-chat,
        #filter-by {
            padding: 10px 15px;
            margin-left: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            box-shadow: none;
        }

        #filter-by:hover {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>
    <div class="row hero">
        <nav class="navigation">
            <a href="../home/indexus.php" class="menu-item">
                <i class="fa-solid fa-house"></i>
                <span>Startseite</span>
            </a>
            <a href="#" class="menu-item active">
                <i class="fa-solid fa-comment-dots"></i>
                <span>Chat</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fa-solid fa-user-group"></i>
                <span>Freunde</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fa-solid fa-handshake"></i>
                <span>Nachhilfe</span>
            </a>
        </nav>
        <div class="content-outer">
            <div class="content-inner">
                <div class="col">
                    <div class="row">
                        <h1>Chat</h1>
                        <button id="make-chat">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button id="filter-by">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                    </div>
                    <div class="row">
                        <input type="text" id="search-chats" placeholder="Chats suchen">
                    </div>
                    <div class="chats">
                        <div class="row">
                            <img src="#" alt="#" width="50" height="50">
                            <div class="col">
                                <span><b>Chat 1</b></span>
                                <p>Person: Hallo</p>
                            </div>
                        </div>
                        <div class="row">
                            <img src="#" alt="#" width="50" height="50">
                            <div class="col">
                                <span><b>Chat 1</b></span>
                                <p>Person: Hallo</p>
                            </div>
                        </div>
                        <div class="row">
                            <img src="#" alt="#" width="50" height="50">
                            <div class="col">
                                <span><b>Chat 1</b></span>
                                <p>Person: Hallo</p>
                            </div>
                        </div>
                        <div class="row">
                            <img src="#" alt="#" width="50" height="50">
                            <div class="col">
                                <span><b>Chat 1</b></span>
                                <p>Person: Hallo</p>
                            </div>
                        </div>
                        <div class="row">
                            <img src="#" alt="#" width="50" height="50">
                            <div class="col">
                                <span><b>Chat 1</b></span>
                                <p>Person: Hallo</p>
                            </div>
                        </div>
                        <div class="row">
                            <img src="#" alt="#" width="50" height="50">
                            <div class="col">
                                <span><b>Chat 1</b></span>
                                <p>Person: Hallo</p>
                            </div>
                        </div>
                        <div class="row">
                            <img src="#" alt="#" width="50" height="50">
                            <div class="col">
                                <span><b>Chat 1</b></span>
                                <p>Person: Hallo</p>
                            </div>
                        </div>

                    </div>
                </div>
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
            playMagic();
            document.getElementById("output").innerHTML = "";

            try {
                const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
                const prompt = promptText;
                const result = await model.generateContent(prompt);
                const response = await result.response;
                const text = await response.text();

                if (text) {
                    document.querySelector(".loading-spinner").classList.add("hidden");
                    if (text.includes('open chat')) {
                        writer("Klar, ich öffne den Chat für dich.");
                        setTimeout(() => {
                            window.open("https://chat.google.com", '_blank');
                        }, 200);
                    } else if (text.includes('open settings')) {
                        writer("Einstellugnen werden geöffnet.")
                        setTimeout(() => {
                            window.open("https://myaccount.google.com/", '_blank');
                        }, 200);
                    } else if (text.includes('not understand')) {
                        writer("Das habe ich nicht verstanden.");
                    } else if (text.includes('open posts')) {
                        writer("Okay, Ich öffne die Posts.")
                        setTimeout(() => {
                            window.open("https://facebook.com", '_blank');
                        }, 200);
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
                stopMagic();
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



        let form = document.querySelector("form");

        form.addEventListener("submit", e => {
            e.preventDefault();
            document.querySelector(".loading-spinner").classList.remove("hidden");
            let value = document.querySelector("form input").value;
            let prompt = "Du heisst Alaris AI. Du bist eine KI für den Einsatz in einer Schul-Webapp. Dein Input kommt meistens von Schülern die diese Webapp benutzen. Deine Aufgabe ist es, Befhele auszuführen oder Fragen zu beantworten. Falls du erkennst, dass der Benutzer etwas machen will(Zb posts öffnen, chat öffnen, etc) kannst du das tun. Falls du merkst, dass der Benutzer nur eine Frage hat, kannst du diese ganz normal beantworten aber nur wenn du nicht in der Frageantwort die Aktion erwähnst. Nach einer Antwort auf eine Frage, musst du aber noch nachfragen, ob der Schüler/in noch etwas machen will und ihm dann verschiedene Aktionen vorschlagen ohne die englische Aktion zu sagen. Hier sind die möglichen Befehle, falls du einen Befehl ausführen musst: open chat, open posts, open settings oder not understand. Diese Aktionen sollst du immer genau so ausgeben, ohne etwas dazu zu sagen. Denk daran, dass ich deine Ausgabe so einfach wie möglich auswerten muss in meinem JS Code. Antworte immer auf deutsch, wenn jemand eine frage stellt, sonst bei einer aktion auf englisch. Wenn du eine Aktion ausgibst, denke daran nur die Aktion auszugeben, wenn du eine Frage beantwortest, bitte nicht die Englische Aktion ausgeben! Hier sind noch einige Informationen: Schule in Wildegg, Brunegg, Holderbank und Möriken verteilt, zussamen Kreisschule Chestenberg.Dieser Input hat der Benutzer gegeben: " + value;
            run(prompt);
        });
    </script>
    <script>
        let index = 0,
            interval = 1000;

        const rand = (min, max) =>
            Math.floor(Math.random() * (max - min + 1)) + min;

        const animate = star => {
            star.style.setProperty("--star-left", `${rand(-10, 100)}%`);
            star.style.setProperty("--star-top", `${rand(-40, 80)}%`);

            star.style.animation = "none";
            star.offsetHeight;
            star.style.animation = "";
        }


        let timeouts = [],
            intervals = [];

        const magic = document.querySelector(".magic");

        magic.onmouseenter = () => {
            let index = 1;

            for (const star of document.getElementsByClassName("magic-star")) {
                timeouts.push(setTimeout(() => {
                    animate(star);

                    intervals.push(setInterval(() => animate(star), 1000));
                }, index++ * 300));
            };
        }

        function playMagic() {
            let index = 1;

            for (const star of document.getElementsByClassName("magic-star")) {
                timeouts.push(setTimeout(() => {
                    animate(star);

                    intervals.push(setInterval(() => animate(star), 1000));
                }, index++ * 300));
            };
        }

        function stopMagic() {
            for (const t of timeouts) clearTimeout(t);
            for (const i of intervals) clearInterval(i);

            timeouts = [];
            intervals = [];
        }

        magic.onmouseleave = onMouseLeave = () => {
            for (const t of timeouts) clearTimeout(t);
            for (const i of intervals) clearInterval(i);

            timeouts = [];
            intervals = [];
        }

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