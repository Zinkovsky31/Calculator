<?php

use yii\db\Migration;

/**
 * Class m230808_091150_change_column_type_to_string
 */
class m230808_091150_change_column_type_to_string extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('history', 'months', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230808_091150_change_column_type_to_string cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230808_091150_change_column_type_to_string cannot be reverted.\n";

        return false;
    }
    */
}
