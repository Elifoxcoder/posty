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
$userData = getCookie(('userData'));

if (!empty($userData)) {
    header('Location: ../home');
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Einloggen</title>
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
            font-weight: 400;
            background-color: var(--color-background);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: var(--color-dark);
        }

        .login-container {
            background-color: var(--color-white);
            padding: 50px 40px;
            border-radius: 12px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            width: 450px;
            max-width: 100%;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
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

        .login-button {
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

        .login-button:hover {
            background-color: var(--color-primary-hover);
        }

        .register-link,
        .forgot-password-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: var(--color-link);
            text-decoration: none;
        }

        .register-link:hover,
        .forgot-password-link:hover {
            color: var(--color-link-hover);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: var(--color-footer);
        }

        .auth {
            width: 100%;
            padding: 15px;
            background-color: var(--color-white);
            color: var(--color-dark);
            border: 1px solid var(--color-dark);
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth img {
            margin-right: 10px;
            width: 20px;
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

    <form class="login-container">
        <div class="login-header">
            <h1>Einloggen</h1>
        </div>
        <div class="error">Error</div>

        <div class="input-field">
            <label for="username">Nutzername</label>
            <input type="text" name="username" id="username" placeholder="Dein Username">
        </div>

        <div class="input-field">
            <label for="password">Passwort</label>
            <input type="password" name="password" id="password" placeholder="Dein Passwort">
        </div>

        <button class="login-button">Einloggen</button>
        <div class="auth google"><img
                src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA"
                alt="Google Icon">Mit Google anmelden</div>
        <a href="../register/" class="register-link">Noch kein Konto? Registrieren</a>
        <a href="forgot-password" class="forgot-password-link">Passwort vergessen?</a>
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
                xhttp.open("POST", "../php/login.php", true);
                xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhttp.send("username=" + document.querySelector("[name=username]").value + "&password=" + document.querySelector("[name=password]").value);
            });
        </script>
</body>

</html>