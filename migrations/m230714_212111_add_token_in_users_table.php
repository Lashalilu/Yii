<?php

use yii\db\Migration;

/**
 * Class m230714_212111_add_token_in_users_table
 */
class m230714_212111_add_token_in_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'token', $this->string(32)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'token');
    }

}
