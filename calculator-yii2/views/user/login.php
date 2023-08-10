<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Alert;

$this->title = 'Авторизация';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
]); ?>

<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<div class="form-group">
    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>
    
</div>
<div class="form-group">
<p>
    <?= Html::a('Зарегистрироваться', ['register'], ['class' => 'btn btn-success']) ?>
</p>
</div>
<div class="form-group">
<p>
    <?= Html::a('Выполнить рассчёт без авторизации ', ['/site/index'], ['class' => 'btn btn-success']) ?>
</p>
</div>

<?php ActiveForm::end(); ?>

