<?php

use yii\db\Migration;

/**
 * Class m230119_172253_date_comment
 */
class m230119_172253_date_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comment','date',$this->date());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230119_172253_date_comment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230119_172253_date_comment cannot be reverted.\n";

        return false;
    }
    */
}
