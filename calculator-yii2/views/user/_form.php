<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(); ?>

<?= $form->field($user, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>


<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>