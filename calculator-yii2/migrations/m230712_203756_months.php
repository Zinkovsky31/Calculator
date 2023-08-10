<?php

use yii\db\Migration;

/**
 * Class m230712_203756_months
 */
class m230712_203756_months extends Migration
{
    /**
     * {@inheritdoc}
     */

     public function up()
     {
         $this->createTable('months', [
             'id' => $this->primaryKey(11)->unsigned()->notNull(),
             'name' => $this->string(10)->unsigned()->notNull()->unique(),
             'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP()'),
             'updated_at' => $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP()")->append('ON UPDATE CURRENT_TIMESTAMP()'),
         ]);
 
         $this->batchInsert('months', ['name'], $this->getMonthsData());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('months');
    }

    private function getMonthsData()
    {
        return [
            ['январь'], ['февраль'], ['август'], ['сентябрь'], ['октябрь'], ['ноябрь']
        ];
    }

}
