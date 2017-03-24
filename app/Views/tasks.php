
Сортировка по:
<a href="?sort=name">Имени</a>
<a href="?sort=status">Статусу</a>
<a href="?sort=heading">Названию</a>
<? foreach ($tasks as $task): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-md-5">
                <a href="/show?id=<?= $task->id ?>"><?= $task->name ?></a>
                <? if ($task->done != 0): ?>
                    <div class="label label-success">Выполнено</div><? endif; ?>
            </div>

            <div class="text-right">
                <b><?= $task->users->name ?></b>

                <!--id Администратора в БД = 20-->
                <? if ($_COOKIE['id'] == 20): ?>
                    <? $authUser = $users->find(20); ?>
                    <? if ($authUser->hash == $_COOKIE['hash']): ?>
                        <a class="label label-warning" href="/edit?id=<?= $task->id ?>">Редактировать</a>
                    <? endif; ?>
                <? endif; ?>

            </div>
        </div>

        <div class="panel-body">
            <img class="img-circle" src="<?= $task->image ?>">
            <?= $task->task ?>
        </div>
    </div>
<? endforeach; ?>


