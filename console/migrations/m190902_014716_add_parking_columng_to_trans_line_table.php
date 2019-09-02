<?php

use yii\db\Migration;

/**
 * Class m190902_014716_add_parking_columng_to_trans_line_table
 */
class m190902_014716_add_parking_columng_to_trans_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190902_014716_add_parking_columng_to_trans_line_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190902_014716_add_parking_columng_to_trans_line_table cannot be reverted.\n";

        return false;
    }
    */
}
