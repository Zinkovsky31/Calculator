<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%calculation_history}}`.
 */
class m230805_200550_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('history', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'raw_types' => $this->string(255),
            'tonnages' => $this->decimal(10, 2),
            'months' => $this->integer(),
            'prices' => $this->decimal(10, 2),
            'price_table' => $this->text(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%history}}');
    } 
}
