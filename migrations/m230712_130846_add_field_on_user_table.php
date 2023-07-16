<?php

use yii\db\Migration;

/**
 * Class m230712_130846_add_field_on_user_table
 */
class m230712_130846_add_field_on_user_table extends Migration
{

    public function safeUp()
    {
        $this->addColumn('users', 'user_category_id', $this->integer()->notNull());

        // Add foreign key constraint
        $this->addForeignKey('fk-users-user_category_id', 'users', 'user_category_id', 'user_type', 'id');
    }


    public function safeDown()
    {
        $this->dropForeignKey('fk-users-user_category_id', 'users');

        $this->dropColumn('users', 'user_category_id');
    }

}
