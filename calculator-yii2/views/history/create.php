<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Calculation';
$this->params['breadcrumbs'][] = ['label' => 'Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'raw_material_type')->textInput() ?>
<?= $form->field($model, 'tonnage')->textInput() ?>
<?= $form->field($model, 'month')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>