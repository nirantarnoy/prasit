<?php

use yii\db\Migration;

/**
 * Handles adding photo to table `{{%customer}}`.
 */
class m190420_045938_add_photo_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'photo', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'photo');
    }
}
