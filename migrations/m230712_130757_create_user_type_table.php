<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_type}}`.
 */
class m230712_130757_create_user_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_type}}');
    }
}
