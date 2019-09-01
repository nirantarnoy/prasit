<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%trans}}`.
 */
class m190829_133439_add_building_id_column_to_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%trans}}', 'building_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%trans}}', 'building_id');
    }
}
