<?php

use yii\db\Migration;

/**
 * Class m230726_102546_user
 */
class m230726_102546_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // Создаем таблицу 'user' с указанными полями
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
        ]);

        // Устанавливаем значение по умолчанию для полей 'name' и 'password'
        $this->alterColumn('user', 'name', $this->string()->notNull()->defaultValue(''));
        $this->alterColumn('user', 'password', $this->string()->notNull()->defaultValue(''));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230726_102546_change_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230726_102546_change_user cannot be reverted.\n";

        return false;
    }
    */
}
