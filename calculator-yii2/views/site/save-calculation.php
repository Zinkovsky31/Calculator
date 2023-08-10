<?php

use app\models\History;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\SnapshotModel; 

/* @var $this yii\web\View */
/* @var $searchModel app\models\SnapshotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'История расчетов';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $this->title ?></h1>

<?= GridView::widget([
    'dataProvider' => new ActiveDataProvider([
        'query' => History::find(), 
    ]),
    'columns' => [
        'id',
        'user_id',
        'raw_type',
        'tonnage',
        'month',
        'created_at',
        // ...
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete}',
            // ...
        ],
    ],
]) ?>