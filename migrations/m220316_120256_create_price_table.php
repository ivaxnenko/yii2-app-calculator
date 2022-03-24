<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price}}`.
 */
class m220316_120256_create_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price}}', [
            'id' => $this->primaryKey(),
            'material_id' => $this->integer()->notNull(),
            'month_id' => $this->integer()->notNull(),
            'weight_id' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP()'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'),
        ]);

        $this->createIndex('idx-price-material_id','{{%price}}', 'material_id');
        $this->createIndex('idx-price-month_id','{{%price}}', 'month_id');
        $this->createIndex('idx-price-weight_id','{{%price}}', 'weight_id');
        $this->createIndex('idx-price-unique_price', '{{%price}}', ['material_id', 'month_id', 'weight_id'], $unique = true );

        $this->addForeignKey(
            'fk-price-material_id',
            '{{%price}}',
            'material_id',
            '{{%material}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-price-month_id',
            '{{%price}}',
            'month_id',
            '{{%month}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-price-weight_id',
            '{{%price}}',
            'weight_id',
            '{{%weight}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        Yii::$app->db->createCommand('INSERT INTO price (material_id, month_id,weight_id, price) VALUES 
        (1,1,1,125),
        (1,1,2,145),
        (1,1,3,136),
        (1,1,4,138),
        (1,2,1,121),
        (1,2,2,118),
        (1,2,3,137),
        (1,2,4,142),
        (1,3,1,137),
        (1,3,2,119),
        (1,3,3,141),
        (1,3,4,117),
        (1,4,1,126),
        (1,4,2,121),
        (1,4,3,137),
        (1,4,4,124),
        (1,5,1,124),
        (1,5,2,122),
        (1,5,3,131),
        (1,5,4,147),
        (1,6,1,128),
        (1,6,2,147),
        (1,6,3,143),
        (1,6,4,112),
        (2,1,1,121),
        (2,1,2,118),
        (2,1,3,137),
        (2,1,4,142),
        (2,2,1,137),
        (2,2,2,121),
        (2,2,3,124),
        (2,2,4,131),
        (2,3,1,124),
        (2,3,2,145),
        (2,3,3,136),
        (2,3,4,138),
        (2,4,1,137),
        (2,4,2,147),
        (2,4,3,143),
        (2,4,4,112),
        (2,5,1,122),
        (2,5,2,143),
        (2,5,3,112),
        (2,5,4,117),
        (2,6,1,125),
        (2,6,2,145),
        (2,6,3,136),
        (2,6,4,138),
        (3,1,1,137),
        (3,1,2,147),
        (3,1,3,112),
        (3,1,4,122),
        (3,2,1,125),
        (3,2,2,145),
        (3,2,3,136),
        (3,2,4,138),
        (3,3,1,124),
        (3,3,2,145),
        (3,3,3,136),
        (3,3,4,138),
        (3,4,1,122),
        (3,4,2,143),
        (3,4,3,112),
        (3,4,4,117),
        (3,5,1,137),
        (3,5,2,119),
        (3,5,3,141),
        (3,5,4,117),
        (3,6,1,121),
        (3,6,2,118),
        (3,6,3,137),
        (3,6,4,142);')
            ->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-price-weight_id','{{%price}}');
        $this->dropForeignKey('fk-price-material_id','{{%price}}');
        $this->dropForeignKey('fk-price-month_id','{{%price}}');

        $this->dropIndex('idx-price-material_id','{{%price}}');
        $this->dropIndex('idx-price-weight_id','{{%price}}');
        $this->dropIndex('idx-price-month_id','{{%price}}');
        $this->dropIndex('idx-price-unique_price', '{{%price}}');

        $this->dropTable('{{%price}}');
    }
}
