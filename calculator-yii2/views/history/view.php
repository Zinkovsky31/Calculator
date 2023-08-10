<?php

use yii\helpers\Html;

$this->title = 'History Details';
$this->params['breadcrumbs'][] = ['label' => 'History', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-bordered">
    <tr>
        <th>Raw Material Type</th>
        <td><?= Html::encode($model->raw_type) ?></td>
    </tr>
    <tr>
        <th>Tonnage</th>
        <td><?= Html::encode($model->tonnage) ?></td>
    </tr>
    <tr>
        <th>Month</th>
        <td><?= Html::encode($model->month) ?></td>
    </tr>
    <tr>
        <th>Calculation Result</th>
        <td><?= Html::encode($model->calculation_result) ?></td>
    </tr>
    <tr>
        <th>Price Table</th>
        <td><?= Html::encode($model->price_table) ?></td>
    </tr>
   
</table>