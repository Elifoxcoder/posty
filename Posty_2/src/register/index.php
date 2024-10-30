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
$userData = getCookie(("userData"));

if (!empty($userData)) {
    header("Location: ../home");
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
    <style>
        :root {
            --color-background: #f6f7f9;
            --color-white: #ffffff;
            --color-dark: #333;
            --color-gray: #dcdcdc;
            --color-light-gray: #f9f9f9;
            --color-primary: #5f5fff;
            --color-primary-hover: #4d4df0;
            --color-label: #555;
            --color-link: #999;
            --color-link-hover: #5f5fff;
            --color-footer: #aaa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @font-face {
            font-family: "Product Sans";
            src: url("../font/Product Sans/ProductSans-Regular.ttf") format("truetype"),
                url("../font/Product Sans/ProductSans-Thin.ttf") format("truetype"),
                url("../font/Product Sans/ProductSans-ThinItalic.ttf") format("truetype"),
                url("../font/Product Sans/ProductSans-Light.ttf") format("truetype"),
                url("../font/Product Sans/ProductSans-LightItalic.ttf") format("truetype"),
                url("../font/Product Sans/ProductSans-Medium.ttf") format("truetype"),
                url("../font/Product Sans/ProductSans-MediumItalic.ttf") format("truetype"),
                url("../font/Product Sans/ProductSans-Bold.ttf") format("truetype"),
                url("../font/Product Sans/ProductSans-BoldItalic.ttf") format("truetype"),
                url("../font/Product Sans/ProductSans-Black.ttf") format("truetype"),
                url("../font/Product Sans/ProductSans-BlackItalic.ttf") format("truetype");
        }

        body {
            font-family: "Product Sans", sans-serif;
            background-color: var(--color-background);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: var(--color-dark);
        }

        .register-container {
            background-color: var(--color-white);
            padding: 50px 40px;
            border-radius: 12px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            width: 450px;
            max-width: 100%;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h1 {
            font-size: 26px;
            font-weight: 500;
            color: var(--color-dark);
        }

        .input-field {
            margin-bottom: 15px;
        }

        .input-field label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--color-label);
        }

        .input-field input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--color-gray);
            border-radius: 8px;
            font-size: 16px;
            background-color: var(--color-light-gray);
            transition: border-color 0.3s;
        }

        .input-field input:focus {
            border-color: var(--color-primary);
            outline: none;
            background-color: var(--color-white);
        }

        .register-button {
            width: 100%;
            padding: 15px;
            background-color: var(--color-primary);
            color: var(--color-white);
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .register-button:hover {
            background-color: var(--color-primary-hover);
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: var(--color-link);
            text-decoration: none;
        }

        .login-link:hover {
            color: var(--color-link-hover);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: var(--color-footer);
        }

        .error {
            display: none;
            align-items: center;
            justify-content: center;
            background: pink;
            color: red;
            border: 1px solid red;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <form class="register-container">
        <div class="register-header">
            <h1>Registrieren</h1>
        </div>
        <div class="error">Error</div>

        <div class="input-field">
            <label for="name">Name</label>
            <input type="text" id="name" placeholder="Dein Name" name="name">
        </div>

        <div class="input-field">
            <label for="email">E-Mail Adresse</label>
            <input type="email" id="email" placeholder="Deine E-Mail" name="email">
        </div>

        <div class="input-field">
            <label for="password">Passwort</label>
            <input type="password" id="password" placeholder="Dein Passwort" name="password">
        </div>

        <button class="register-button">Registrieren</button>

        <a href="../login/" class="login-link">Bereits registriert? Anmelden</a>
        </div>
        <script>
            document.querySelector("form").addEventListener("submit", (e) => {
                e.preventDefault();
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function () {
                    if (xhttp.response == "success") {
                        location.href = "../home";
                    } else {
                        document.querySelector(".error").innerHTML = xhttp.response;
                        document.querySelector(".error").style.display = "flex";
                    }

                }
                xhttp.open("POST", "../php/register.php", true);
                xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhttp.send("email=" + document.querySelector("[name=email]").value + "&password=" + document.querySelector("[name=password]").value + "&name=" + document.querySelector("[name=name]").value);
            });
        </script>
</body>

</html>