<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "weight".
 *
 * @property int $id
 * @property int $count
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Price[] $prices
 */
class Weight extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count'], 'required'],
            [['count'], 'integer'],
            ['count', 'unique', 'message' => 'Данный тоннаж уже существует'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'count' => 'Тоннаж',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Prices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['weight_id' => 'id']);
    }
}
