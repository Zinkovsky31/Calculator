<?php

namespace app\commands;

use app\rbac\IsOwnerRule;
use Exception;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class RbacController extends Controller
{
    /**
     * @throws Exception
     */
    public function actionInit()
    {
        $authManager = Yii::$app->authManager;

        // Разрешения
        $executeCalculation = $authManager->createPermission('executeCalculation');
        $executeCalculation->description = 'Доступно выполнение расчета без авторизации';
        $authManager->add($executeCalculation);

        $writeHistory = $authManager->createPermission('writeHistory');
        $writeHistory->description = 'Доступно запись результата расчета в историю';
        $authManager->add($writeHistory);

        $manageUsers = $authManager->createPermission('manageUsers');
        $manageUsers->description = 'Доступно управление пользователями (просмотр, создание, удаление, изменение)';
        $authManager->add($manageUsers);

        $viewAllCalculations = $authManager->createPermission('viewAllCalculations');
        $viewAllCalculations->description = 'Доступно просмотр всех расчетов пользователей';
        $authManager->add($viewAllCalculations);

        // Роли
        $guest = $authManager->createRole('guest');
        $authManager->add($guest);
        $authManager->addChild($guest, $executeCalculation);

        $user = $authManager->createRole('user');
        $authManager->add($user);
        $authManager->addChild($user, $executeCalculation);
        $authManager->addChild($user, $writeHistory);

        $administrator = $authManager->createRole('administrator');
        $authManager->add($administrator);
        $authManager->addChild($administrator, $executeCalculation);
        $authManager->addChild($administrator, $writeHistory);
        $authManager->addChild($administrator, $manageUsers);
        $authManager->addChild($administrator, $viewAllCalculations);

        echo "RBAC инициализирован.\n";

        
    }

}
