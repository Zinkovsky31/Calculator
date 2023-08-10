<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Назначение роли';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['user/index']]; // Замените на нужный URL
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'userId')->dropDownList($userList) ?>

<?= $form->field($model, 'roleName')->dropDownList($roleList) ?>

<div class="form-group">
    <?= Html::submitButton('Назначить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>