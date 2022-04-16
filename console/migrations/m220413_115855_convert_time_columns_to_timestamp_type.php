<?php

use yii\db\Migration;

/**
 * Class m220413_115855_convert_time_columns_to_timestamp_type
 */
class m220413_115855_convert_time_columns_to_timestamp_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{post}}', 'created_at');
        $this->addColumn('{{post}}', 'created_at', 'timestamptz');

        $this->dropColumn('{{post}}', 'updated_at');
        $this->addColumn('{{post}}', 'updated_at', 'timestamptz');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{post}}', 'updated_at');
        $this->addColumn('{{post}}', 'updated_at', 'integer');

        $this->dropColumn('{{post}}', 'created_at');
        $this->addColumn('{{post}}', 'created_at', 'integer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220413_115855_convert_time_columns_to_timestamp_type cannot be reverted.\n";

        return false;
    }
    */
}
