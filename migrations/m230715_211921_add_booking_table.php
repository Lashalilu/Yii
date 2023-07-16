<?php

use yii\db\Migration;

/**
 * Class m230715_211921_add_booking_table
 */
class m230715_211921_add_booking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%booking}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'service_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
            'address' => $this->string()->notNull(),

        ]);

        $this->addForeignKey('fk-booking-user_id', 'booking', 'user_id', 'users', 'id');
        $this->addForeignKey('fk-booking-service_id', 'booking', 'service_id', 'service', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230715_211921_add_booking_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230715_211921_add_booking_table cannot be reverted.\n";

        return false;
    }
    */
}
