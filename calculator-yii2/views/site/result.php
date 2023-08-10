<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Modal;
?>


<table class="table table-bordered border-warning table-hover bg-transparent">

</table>

<div class="mb-2 d-flex justify-content-between">

            <?php 

             if (empty($model->raw_type) === false): ?>
                
                <div class="site-result">
                    <p>Cырье: <?= $model->raw_type ?></p>
                    <p>Тоннаж: <?= $model->tonnage ?></p>
                    <p>Месяц: <?= $model->month ?></p>
                    
                    <table class="table table-bordered border-warning table-hover bg-transparent">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <?php foreach ($repository->getMonthsList() as $month): ?>
                                <th scope="col"><?= $month ?></th>
                            <?php endforeach; ?>
                        </tr>

                        </thead>
                        <tbody>

                        <?php foreach ($repository->getTonnagesList() as $tonnage): ?>
                            <tr>
                                <th scope="row"><?= $tonnage ?></th>
                                <?php foreach ($repository->getMonthsList() as $month): ?>
                                    <td

                                    <?php if ((string)$tonnage === $model->tonnage && $month === $model->month): ?> class="bg-warning" <?php endif; ?>>
                                        <?= $repository->getResultPrice($model->raw_type, $tonnage, $month) ?></td>
                                        
                                        <?php endforeach; ?>
                                

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <?php Modal::widget();
 ?>
            <?php endif; ?>
        </div>


<span class="badge text-bg-warning fs-5"><p>Стоимость доставки: <b><?= $repository->getResultPrice($model->raw_type, $model->tonnage, $model->month) . ' тыс. руб.' ?></b></p></span>
</div>


