<?php

use yii\db\Migration;

/**
 * Class m200523_060333_addTelemetricTable
 * With description table for telemetric from REST Api
 */
class m200523_060333_addTelemetricTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('metrics', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'field' => $this->string(),
            'value' => $this->string(),
            'date' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('metrics');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200523_060333_addTelemetricTable cannot be reverted.\n";

        return false;
    }
    */
}
