<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Moove Driver</title>
    <script src="https://kit.fontawesome.com/f5a1d28d53.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/public/css/head.css">
    
</head>
<body>
    <nav class="navbar1">
        <div class="logo1">
            <img src="/public/img/logo.png" alt="Logo"> Free Moove Driver
        </div>
        <div class="menu" onclick="toggleMenu()">&#9776;</div>
        <ul id="nav-links">
            <li><a href="/licence">Licence</a></li>
            <?php if (isset($_SESSION['user'])) { ?>
                <?php if ($_SESSION['user']['idRole'] == 1 || $_SESSION['user']['idRole'] == 2) { ?>
                    <li><a href="/addLicence">Ajouter une licence</a></li>
                <?php } ?>
                <li><a href="/profil">Profil</a></li>
                <li><a href="/logout">Déconnexion</a></li>
            <?php } else { ?>
                <li><a href="/login">Connexion</a></li>
            <?php } ?>
        </ul>
        <div class="profilIcon">
            <i class="fas fa-user-circle"></i>
        </div>
    </nav>

    <script>
        function toggleMenu() {
            document.getElementById('nav-links').classList.toggle('active');
        }
    </script>
</body>
</html>
