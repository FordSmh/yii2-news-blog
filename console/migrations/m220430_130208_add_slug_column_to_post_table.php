<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%post}}`.
 */
class m220430_130208_add_slug_column_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%post}}', 'slug', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%post}}', 'slug');
    }
}
