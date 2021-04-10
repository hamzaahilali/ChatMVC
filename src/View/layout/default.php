
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ChatApp</title>
    <!--<script src="https://kit.fontawesome.com/9b277c3e7f.js"></script>-->
    <link rel="stylesheet" type="text/css" href="web/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="web/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">T’chat</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="?page=default.home">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <?php if (!isset($_SESSION['auth'])): ?>
            <li class="nav-item">
                <a class="nav-link" href="?page=default.login">Connexion</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="?page=user.index">Messagerie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=default.logout">Se déconnecter</a>
            </li>
            <?php endif ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<div class="container">
    <?= $content; ?>


    <footer id="footer">
        <div class="row">
            <div class="col-lg-12">
                Copyright © 2021 HZM
            </div>
        </div>

    </footer>
</div>



</body>
</html>

