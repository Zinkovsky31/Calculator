<?php
// controllers/UserController.php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class UserController extends Controller
{
    
 public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['logout','login', 'register'],

                    ],
                    
                    [
                        'allow' => true,
                        'actions' => [   'delete', 'view-all-calculations','executeCalculation', 'site', 'index'],
                        'roles' => ['user'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [ 'admin', 'view', 'update', 'delete'],
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
    
    
    
    
    public function actionRegister()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            $model->save();
            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('user');
            $auth->assign($authorRole, $model->getId());
       
            return $this->redirect(['login']); 
        }
        return $this->render('register', ['model' => $model]);
    }
   
    public function actionLogin()
    {
        $model = new User();
        

        if ($model->load(Yii::$app->request->post())) 
        {
            
            $user = User::findOne([
                'email' => $model->email,
                'password' => $model->password,
            ]);

            if ($user) 
            {
                Yii::$app->user->login($user);
                Yii::$app->session->setFlash('show-notification', true);
                Yii::$app->session->setFlash('user-name', $user->name);
                return $this->redirect(['site/index']);
            } else 
            {
                Yii::$app->session->setFlash('error', 'Invalid email or password.');
            }
        }

        return $this->render('login', ['model' => $model]);
    }
    public function actionLogout()
{
    Yii::$app->user->logout(); 
    return $this->redirect(['site/index']); 
}
public function actionAdmin()
{
    $dataProvider = new ActiveDataProvider([
        'query' => User::find(),
    ]);

    return $this->render('admin', [
        'dataProvider' => $dataProvider,
    ]);
}
public function actionView($id)
{
    $user = User::findOne($id);

    return $this->render('view', [
        'user' => $user,
    ]);
}
public function actionUpdate($id)
{
    $user = User::findOne($id);

    if ($user->load(Yii::$app->request->post()) && $user->save()) {
        return $this->redirect(['view', 'id' => $user->id]);
    }

    return $this->render('update', [
        'user' => $user,
    ]);
}
public function actionDelete($id)
{
    $user = User::findOne($id);
    $user->delete();

    return $this->redirect(['site/index']);
}
     

    
    
}

?>