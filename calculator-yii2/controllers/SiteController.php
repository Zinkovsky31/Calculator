<?php

namespace app\controllers;

use app\models\CalculatorForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\PricesRepository;
use app\models\History;
use yii\widgets\ActiveForm;



class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }



    /**
     * Displays about page.
     *
     * @return string
     */
    
   
     public function actionIndex()
     {
         $model = new CalculatorForm();
         $repository = new PricesRepository();
 
         if ($model->load(Yii::$app->request->post())) {
             $session = Yii::$app->session;
             $session->close();
             
             if (Yii::$app->user->isGuest === false) {
                 $history = new History();
                 $history->snapshot($model);
                
             };
             return $this->renderAjax('result', [
                 'model' => $model,
                 'repository' => $repository,
             ]);
 
 
             
         }
         
         return $this->render('index', [
             'model' => $model,
             'repository' => $repository,
         ]);
     }

public function actionAjaxValidation()
{
    $fieldName = Yii::$app->request->post('field');
    $value = Yii::$app->request->post('value');


    $isValid = !empty($value);

    return json_encode(['valid' => $isValid]);
}
public function actionCalculatorValidation()
    {
        $model = new CalculatorForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }



public function actionHideNotification()
    {
        if (Yii::$app->request->isAjax && Yii::$app->request->post('hideNotification')) {
            Yii::$app->session->setFlash('hide-notification', true);
            return 'success';
        }
        return 'error';
    }
    public function actionSaveCalculation()
{
    $model = new History();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Расчет успешно сохранен.');
        return $this->redirect(['history/view', 'id' => $model->id]); 
    } else {
        Yii::$app->session->setFlash('error', 'Ошибка сохранения: ' . print_r($model->errors, true));
    }

    return $this->render('/history/index', ['model' => $model]);
}
}


     







