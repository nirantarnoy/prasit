<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%building}}`.
 */
class m190901_025704_add_water_unit_per_column_to_building_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%building}}', 'water_unit_per', $this->float());
        $this->addColumn('{{%building}}', 'elect_unit_per', $this->float());
        $this->addColumn('{{%building}}', 'parking_rate', $this->float());
        $this->addColumn('{{%building}}', 'fee_rate', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%building}}', 'water_unit_per');
        $this->dropColumn('{{%building}}', 'elect_unit_per');
        $this->dropColumn('{{%building}}', 'parking_rate');
        $this->dropColumn('{{%building}}', 'fee_rate');
    }
}
