<html>
<title>Task-Manager</title>

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>
    <script src="/public/js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
</head>

<body>

<div class="panel panel-default">
    <nav class="navbar navbar-inverse">
        <div class="text-left col-md-4">
            <a href="/">
                <button type="button" class="logout btn btn-default navbar-btn">На главную</button>
            </a>
        </div>
        <div class="text-right">
            <a href="/new-task">
                <button type="button" class="logout btn btn-default navbar-btn">Добавить задачу</button>
            </a>
            <a href="/registration">
                <button type="button" class="logout btn btn-default navbar-btn">Регистрация</button>
            </a>

            <? if (isset($_COOKIE['name'])) : ?>
                <a href="/logout">
                    <button type="button" class="logout btn btn-default navbar-btn">(<?= $_COOKIE['name'] ?>)Выйти
                    </button>
                </a>
            <? else: ?>
                <a href="/auth">
                    <button type="button" class="logout btn btn-default navbar-btn">Войти</button>
                </a>
            <? endif; ?>
        </div>
    </nav>

    <div class="panel-body">
        <? include $_CONTENT_VIEW ?>
    </div>
</div>


</body>
</html>