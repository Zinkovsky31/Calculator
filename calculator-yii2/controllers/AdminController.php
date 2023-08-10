<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class RoleController extends Controller
{
    public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::class,
            'only' => ['admin'], 
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['administrator'], 
                ],
            ],
        ],
    ];
}

    public function actionIndex($userId, $roleName)
    {
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($roleName);
        $authManager->assign($role, $userId);

        Yii::$app->session->setFlash('success', 'Роль успешно назначена пользователю.');
        return $this->redirect(['user/view', 'id' => $userId]); 
    }

    public function actionRevokeRole($userId, $roleName)
    {
        $authManager = Yii::$app->authManager;
        $role = $authManager->getRole($roleName);
        $authManager->revoke($role, $userId);

        Yii::$app->session->setFlash('success', 'Роль успешно снята с пользователя.');
        return $this->redirect(['user/view', 'id' => $userId]); 
    }
   
   //
    public function actionAssignRole($id)
{
    $model = $this->findModel($id);
    $auth = Yii::$app->authManager;

    // Очистка всех текущих ролей пользователя
    $auth->revokeAll($model->id);

    $roles = Yii::$app->request->post('roles', []);
    foreach ($roles as $roleName) {
        $role = $auth->getRole($roleName);
        $auth->assign($role, $model->id);
    }

    Yii::$app->session->setFlash('success', 'Роли пользователя успешно обновлены.');
    return $this->redirect(['view', 'id' => $model->id]);
}
protected function getRoles()
{
    $auth = Yii::$app->authManager;
    $roles = $auth->getRoles();
    $roleNames = [];
    foreach ($roles as $role) {
        $roleNames[$role->name] = $role->description;
    }
    return $roleNames;
}
public function actionView($id)
{
    $model = $this->findModel($id);
    $roles = $this->getRoles();
    $modelRoles = array_keys(Yii::$app->authManager->getRolesByUser($model->id));

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('view', [
        'model' => $model,
        'roles' => $roles,
        'modelRoles' => $modelRoles,
    ]);
}
}