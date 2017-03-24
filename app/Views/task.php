<div class="panel panel-default">
    <div class="panel-heading">
        <a href="/show?id=<?= $task->id ?>"><?= $task->name ?></a><?= $user->name ?>
    </div>

    <div class="panel-body">
        <img src="<?= $task->image ?>">
        <?= $task->task ?>
    </div>
</div>