<?php

use yii\db\Migration;

/**
 * Class m230119_193632_article_cols_delete
 */
class m230119_193632_article_cols_delete extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('article', 'viewed');
        $this->dropColumn('article', 'status');
        $this->dropColumn('article', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230119_193632_article_cols_delete cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230119_193632_article_cols_delete cannot be reverted.\n";

        return false;
    }
    */
}
