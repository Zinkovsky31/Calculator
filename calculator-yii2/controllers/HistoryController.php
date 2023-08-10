<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\History;
use app\models\HistorySearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class HistoryController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new HistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    
    // ...
    public function actionDelete($id)
    {
        History::findOne($id)->delete();
        return $this->redirect('/history/index');
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['guest'], 
                    ],
                    [
                        'allow' => true,
                        'actions' => ['calculate','executeCalculation','user', 'index'],
                        'roles' => ['user'], 
                    ],
                    [
                        'allow' => true,
                        'actions' => ['admin', 'create', 'update', 'delete', 'view-all-calculations','executeCalculation', 'site', 'index'],
                        'roles' => ['administrator'], 
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
}

    

