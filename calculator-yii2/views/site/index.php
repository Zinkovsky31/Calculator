<?php


use yii\bootstrap5\Modal;
use app\models\PricesRepository;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\CalculatorForm;
use yii\helpers\Url;


/** @var  app\models\PricesRepository $repository */
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var  app\models\CalculatorForm $model */


$prices = Yii::$app->params;


$form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute('site/calculator-validation'),
    "id" => "form",
    "method" => "post",
]);

$this->title = "Калькулятор стоимости доставки сырья";

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<h1><?= Html::encode($this->title) ?></h1>
<div class="container  ">
    <div class="d-flex justify-content-start w-50  ">
        <fieldset class="form-control bg-dark " id="disabledInput" type="text" placeholder="...">
            <legend class="text-light" >Калькулятор стоимости доставки сырья</legend>
            <div>
            
                <div class="mb-3 text-light ">
                    <?=
                    $form
                        ->field($model, 'raw_type')
                        ->label("Тип сырья")
                        ->dropDownList($repository->getRawTypesList(),
                        ['prompt' => 'Не выбрано'],
        ) ?>
                </div>
                <div class="mb-3 text-light ">
                    <?= $form
                        ->field($model, 'month')
                        ->label("Месяц")
                        ->dropDownList($repository->getMonthsList(),
                        ['prompt' => 'Не выбрано']
        ) ?>
                </div>
                <div class="mb-3 text-light ">
                    <?= $form
                        ->field($model, 'tonnage')
                        ->label("Тоннаж")
                        ->dropDownList($repository->getTonnagesList(),
                        ['prompt' => 'Не выбрано'])
                         ?>
                </div>
            </div>
            
            <?= Html::submitButton("Рассчитать", ["class" => "btn  btn-outline-light"]) ?>
        </fieldset>
    </div>
    
    
    <div class="form-group">
  
     <?= Html::a('История расчетов', ['history/index'], ['class' => 'btn btn-success']) ?>
</div>
    <?php ActiveForm::end(); 
    ;?>
</div>
        <div id="result-container"></div>
    </div>
</div>
<?php
$js = <<<JS

$(document).ready(function () {
    
    
    $('#form').on('beforeSubmit', function (event) {
        
        event.preventDefault();
        
        var data = $(this).serialize();
        
        
        $.ajax({
            url: '/site/index',
            type: 'POST',
            data: data,
            success: function (response) {
                
                $('#result-container').html(response);
            },
            error: function (xhr, status, error) {
                
                alert('Произошла ошибка при отправке AJAX-запроса.');
            }
        });
        return false;
    });
});



JS;

$this->registerJs($js);

?>


