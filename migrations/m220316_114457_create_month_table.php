<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%month}}`.
 */
class m220316_114457_create_month_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%month}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP()'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'),
        ]);

        Yii::$app->db->createCommand()->batchInsert('{{%month}}', ['name'], [
            ['Январь'],
            ['Февраль'],
            ['Август'],
            ['Сентябрь'],
            ['Октябрь'],
            ['Ноябрь'],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%month}}');
    }
}
