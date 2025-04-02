<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Moove Driver</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/f5a1d28d53.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/public/css/head.css">

</head>

<body>
    <nav class="custom-navbar1">
        <div class="custom-logo">
            <a href="/"><img src="/public/img/logo2.png" alt="Logo"></a>
        </div>
        <div class="custom-menu" onclick="toggleMenu()">&#9776;</div>
        <ul class="ulNav" id="nav-links">
            <li><a href="">Accueil</a></li>
            <li><a href="">À propos</a></li>
            <li><a href="/licence"><strong>Licence</strong></a></li>
         
        </ul>
        <!-- La div profilMenu, poussée à droite -->
        <div class="profilMenu dropdown">
            <a href="#" class="dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle"></i>
                <?php if (!empty($_SESSION['user'])) { ?>
                    <span><?php echo htmlspecialchars($_SESSION['user']['surname'] . ' ' . $_SESSION['user']['name']); ?></span>
                <?php } ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                <?php if (!empty($_SESSION['user'])) { ?>
                    <li><a class="dropdown-item" href="/profil">Profil</a></li>
                    <li><a class="dropdown-item" href="/logout">Déconnexion</a></li>
                <?php } else { ?>
                    <li><a class="dropdown-item" href="/login">Connexion</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <script>
        function toggleMenu() {
            document.getElementById('nav-links').classList.toggle('active');
        }
    </script>
</body>

</html>
