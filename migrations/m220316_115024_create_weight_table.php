<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%weight}}`.
 */
class m220316_115024_create_weight_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%weight}}', [
            'id' => $this->primaryKey(),
            'count' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP()'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'),
        ]);

        Yii::$app->db->createCommand()->batchInsert('{{%weight}}', ['count'], [
            [25],
            [50],
            [75],
            [100]
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%weight}}');
    }
}
