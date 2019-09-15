<div class="row">
    <div class="col-lg-6">
        <h2>Connexion</h2>
        <?php if (isset($error_login)): ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erreur!</strong> <?= $error_login; ?>
            </div>
        <?php endif ?>

        <form action="?page=default.login" METHOD="POST">
            <fieldset>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="emailAuth" class="form-control" id="exampleInputEmail1"
                           aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="passwordAuth" class="form-control" id="exampleInputPassword1"
                           placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
    <div class="col-lg-6">
        <h2>Inscription</h2>
        <?php if (isset($error_register)): ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Erreur!</strong> <?= $error_register; ?>
            </div>
        <?php endif ?>
        <form action="?page=default.register" METHOD="POST">
            <fieldset>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                           aria-describedby="emailHelp"
                           placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInput">Nom</label>
                    <input type="text" name="lastName" class="form-control" id="exampleInputLastName" placeholder="Nom"
                           required>
                </div>
                <div class="form-group">
                    <label for="exampleInputFirstname">Prénom</label>
                    <input type="text" name="firstName" class="form-control" id="exampleInputFirstname"
                           placeholder="Prénom" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password (Min : 6 caractères)</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                           placeholder="Password" pattern=".{6,}" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password confirmation</label>
                    <input type="password" name="confPassword" class="form-control" id="exampleInputPassword1"
                           placeholder="Password" pattern=".{6,}" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
</div>
