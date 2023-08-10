<?php

use yii\helpers\Html;

$this->title = 'Редактирование пользователя: ' . $user->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление пользователями', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->name, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
    ]) ?>

</div>