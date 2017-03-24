<h2>Авторизация</h2>
<hr>
<div class="panel-heading "><?= $error ?? null ?></div>
<form class="navbar-form navbar-left" action="/login" method="post">
    <div class="form-group">
        email:
        <input type="text" class="form-control" name="email" value="<?= $email ?? null ?>" placeholder="email">
        password:
        <input type="password" class="form-control" name="password" placeholder="password">
        <input type="submit" class="btn btn-default">
    </div>
</form>