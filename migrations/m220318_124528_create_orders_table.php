<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m220318_124528_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'month' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'weight' => $this->integer()->notNull(),
            'tprice' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP()'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'),
        ]);

        $this->createIndex('idx-orders-user_id','{{%orders}}', 'user_id');

        $this->addForeignKey(
            'fk-orders-user_id',
            '{{%orders}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-orders-user_id','{{%orders}}');

        $this->dropIndex('idx-orders-user_id','{{%orders}}');

        $this->dropTable('{{%orders}}');
    }
}
