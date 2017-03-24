<div class="panel panel-default">
    <div class="panel-heading">
        Новая задача
    </div>

    <div class="panel-body">
        <form class="navbar-form navbar-left" enctype="multipart/form-data" action="/new-task" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" value="<?= $task->name ?? null ?>"
                       placeholder="Заголовок">
                <input type="text" class="form-control" name="task" value="<?= $task->task ?? null ?>"
                       placeholder="Задача">
                <input type="file" class="form-control" name="image" value="<?= $task->image ?? null ?>"
                       placeholder="image">

                <!--id Администратора в БД = 20-->
                <? if ($_COOKIE['id'] == 20): ?>
                    <? $authUser = $users->find(20); ?>
                    <? if ($authUser->hash == $_COOKIE['hash']): ?>
                        Выполенено: <input type="checkbox" name="done" value="1">
                    <? endif; ?>
                <? endif; ?>

                <input type="hidden" name="id" value="<?= $id ?? null ?>">
                <input type="submit" class="btn btn-default">
                <input type="button" id="preview-button" class="btn btn-default" value="Предпросмотр">
            </div>
        </form>
    </div>
</div>

<div class="panel panel-default preview-block">
    <div class="panel-heading">
        Предварительный просмотр
    </div>

    <div class="panel-body">
        <div id="preview">
            <img id="image-view" style="width:200px"/>
            <div class="content">

            </div>
        </div>
    </div>
</div>



