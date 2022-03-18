<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220318_124506_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->unique(),
            'password' => $this->integer(),
            'role' => $this->string()->defaultValue('user'),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP()'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'),
        ]);

        $this->insert( '{{%user}}', [
            'username' => 'admin',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'role' => 'admin'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
