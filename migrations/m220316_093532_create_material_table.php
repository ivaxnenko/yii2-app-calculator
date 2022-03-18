<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%material}}`.
 */
class m220316_093532_create_material_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%material}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP()'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'),
        ]);

        Yii::$app->db->createCommand()->batchInsert('{{%material}}', ['name'], [
            ['Шрот'],
            ['Жмых'],
            ['Соя'],
        ])->execute();
    }

    

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%material}}');
    }
}
