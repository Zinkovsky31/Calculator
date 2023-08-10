<?php

use yii\db\Migration;

/**
 * Class m230712_203726_tonnages
 */
class m230712_203726_tonnages extends Migration
{
     /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('tonnages', [
            'id' => $this->primaryKey(11)->unsigned()->notNull(),
            'value' => $this->tinyInteger()->unsigned()->notNull()->unique(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP()'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP()")->append('ON UPDATE CURRENT_TIMESTAMP()'),
        ]);

        $this->batchInsert('tonnages', ['value'], $this->getTonnagesData());

        
    }




    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('tonnages');
    }
    private function getTonnagesData(): array
    {
        return [[25], [50], [75], [100]];
    }


}
