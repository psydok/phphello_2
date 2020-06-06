<?php

use yii\db\Migration;

/**
 * Class m200606_090704_addAccessToken
 */
class m200606_090704_addAccessToken extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'accessToken', $this->char(128));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'accessToken');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200606_090704_addAccessToken cannot be reverted.\n";

        return false;
    }
    */
}
