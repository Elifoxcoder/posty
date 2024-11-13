<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posty</title>
    <script src="https://kit.fontawesome.com/08ca15d3fb.js" crossorigin="anonymous"></script>
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
            color: #aaa;
            cursor: pointer;
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

        nav .input-section input::placeholder {
            color: #222;
        }

        nav .input-section {
            padding: 25px;
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

        html .post .media-container {
            display: flex !important;
        }

        html .post .main-media {
            width: 100% !important;
            max-height: 500px !important;
            border-radius: 15px !important;
            object-fit: contain !important;
        }

        html .post .small-media {
            width: 100px !important;
            height: auto !important;
            border-radius: 8px !important;
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
            <img src="https://images.pexels.com/photos/2876486/pexels-photo-2876486.png?cs=srgb&dl=pexels-dshanp-2876486.jpg&fm=jpg"
                alt="#">
            <div class="col">
                <span><b>Black Slave</b></span>
                <p>mail@elifox.ch</p>
            </div>
            <button class="open-settings-btn">
                <i class="fa-solid fa-gear"></i>
            </button>
        </div>
    </nav>
    <main>
        <div class="posts">
            <div class="post">
                <div class="profile">
                    <img src="https://images.pexels.com/photos/2876486/pexels-photo-2876486.png?cs=srgb&dl=pexels-dshanp-2876486.jpg&fm=jpg"
                        alt="#">
                    <div class="col">
                        <span><b>Black Slave</b></span>
                        <p>Gerade eben</p>
                    </div>
                </div>
                <div class="descr">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores voluptatibus id minus itaque
                        error, quo in voluptate tempore nulla.</p>
                </div>
                <div class="img">
                    <img src="https://scontent.fzrh4-1.fna.fbcdn.net/v/t39.30808-6/461949697_8566165603499028_8037321510088563207_n.jpg?stp=dst-jpg_p180x540&_nc_cat=1&ccb=1-7&_nc_sid=aa7b47&_nc_ohc=AGrIzRFporMQ7kNvgECgMGJ&_nc_ht=scontent.fzrh4-1.fna&_nc_gid=ACHSpA13O5BafD09LD22n8d&oh=00_AYAu2QN5ltjvQ7NVVoE_zXA-nSCxMddFXWo1nFQAiz9i0w&oe=670AE533"
                        alt="image">
                </div>
                <div class="actions">
                    <button><i class="fa-regular fa-heart"></i> Like</button>
                    <button><i class="fa-solid fa-message"></i> Kommentare</button>
                    <button><i class="fa-solid fa-plus"></i> Merken</button>
                    <button><i class="fa-solid fa-share"></i> Teilen</button>
                </div>
            </div>
            <div class="post">
                <div class="profile">
                    <img src="https://images.pexels.com/photos/2876486/pexels-photo-2876486.png?cs=srgb&dl=pexels-dshanp-2876486.jpg&fm=jpg"
                        alt="#">
                    <div class="col">
                        <span><b>Black Slave</b></span>
                        <p>Gestern</p>
                    </div>
                </div>
                <div class="descr">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores voluptatibus id minus itaque
                        error, quo in voluptate tempore nulla.</p>
                </div>
                <div class="actions">
                    <button><i class="fa-regular fa-heart"></i> Like</button>
                    <button><i class="fa-solid fa-message"></i> Kommentare</button>
                    <button><i class="fa-solid fa-plus"></i> Merken</button>
                    <button><i class="fa-solid fa-share"></i> Teilen</button>
                </div>
            </div>
        </div>
    </main>
    <datalist id="browse-with-alaris-datalist">
        <option value="Chat öffnen"></option>
        <option value="Chat erstellen"></option>
        <option value="Nachhilfe"></option>
        <option value="Freunde ansehen"></option>
        <option value="Post erstellen"></option>
        <option value="Posts öfnnen"></option>
    </datalist>
    <script>
        let alraisInput = document.getElementById("browse-with-alaris");

        alraisInput.oninput = function () {
            if (alraisInput.value === "Chat öffnen") {
                location.href = "../chat";
            } else if (alraisInput.value === "Chat erstellen") {
                location.href = "../chat/create.php";
            } else if (alraisInput.value === "Nachhilfe") {
                location.href = "../help";
            } else if (alraisInput.value === "Freunde ansehen") {
                location.href = "../friends";
            } else if (alraisInput.value === "Post erstellen") {
                location.href = "./create.php";
            } else if (alraisInput.value === "Posts öffnen") {
                location.href = "./index.php";
            }
            alraisInput.value = "";
        };

        alraisInput.addEventListener("keydown", e => {
            if (event.key === 'Enter') {

            }
        });


        function fetchPosts() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '../php/get-posts.php', true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.querySelector(".posts").innerHTML = xhr.response;
                } else {
                    console.error('Error fetching posts:', xhr.statusText);
                }
            };

            xhr.send();
        }

        // Call the function to fetch the posts
        fetchPosts();

        document.addEventListener("keydown", (e) => {
            if (e.key == "k") {
                toggleNavigation();
            }
        });

        function toggleNavigation() {
            const navigation = document.querySelector('nav');
            navigation.classList.toggle('folded-in');
        }
    </script>
</body>

</html>