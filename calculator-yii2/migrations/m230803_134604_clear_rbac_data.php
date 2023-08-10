<?php

use yii\db\Migration;

/**
 * Class m230803_134604_clear_rbac_data
 */
class m230803_134604_clear_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Проверяем, что компонент authManager настроен
        if (Yii::$app->authManager !== null) {
            // Очищаем данные RBAC
            $auth = Yii::$app->authManager;
            $auth->removeAll();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230803_134604_clear_rbac_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230803_134604_clear_rbac_data cannot be reverted.\n";

        return false;
    }
    */
}
