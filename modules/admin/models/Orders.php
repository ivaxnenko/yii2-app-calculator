<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $user_id
 * @property string $month
 * @property string $type
 * @property int $weight
 * @property int $tprice
 * @property int $price
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'weight', 'month', 'type', 'tprice', 'price', 'distance'], 'required'],
            [['user_id', 'weight', 'tprice', 'price','distance'], 'integer' , 'min' => 1],
            [['created_at', 'updated_at'], 'safe'],
            [['month', 'type'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Пользователь',
            'month' => 'Месяц',
            'type' => 'Сырье',
            'weight' => 'Тоннаж',
            'tprice' => 'Цена за тонну',
            'price' => 'Стоимость',
            'distance' => 'Расстояние',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
