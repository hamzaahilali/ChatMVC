<?php if (!isset($_SESSION['auth'])): ?>
    <div class="jumbotron">
        <h1 class="display-3">Hello, world!</h1>
        <p class="lead">Simple chat application</p>
        <hr class="my-4">
        <p>PHP7/MVC,MySql,Bootstrap</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p>
    </div>
<?php else: ?>
    <div class="jumbotron">
        <h1 class="display-3">Bonjour, <?= $_SESSION["firstName"]; ?> <?= $_SESSION["lastName"]; ?></h1>
        <p class="lead">Simple chat application</p>
        <hr class="my-4">
        <p>PHP7/MVC,MySql,Bootstrap,jquery,Ajax</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </p>
    </div>

<?php endif ?>
