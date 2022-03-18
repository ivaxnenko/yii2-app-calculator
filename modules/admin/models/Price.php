<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property int $id
 * @property int $material_id
 * @property int $month_id
 * @property int $weight_id
 * @property int $price
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Material $material
 * @property Month $month
 * @property Weight $weight
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material_id', 'month_id', 'weight_id', 'price'], 'required'],
            [['material_id', 'month_id', 'weight_id', 'price'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Material::className(), 'targetAttribute' => ['material_id' => 'id']],
            [['month_id'], 'exist', 'skipOnError' => true, 'targetClass' => Month::className(), 'targetAttribute' => ['month_id' => 'id']],
            [['weight_id'], 'exist', 'skipOnError' => true, 'targetClass' => Weight::className(), 'targetAttribute' => ['weight_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'material_id' => 'ID сырья',
            'month_id' => 'ID месяца',
            'weight_id' => 'ID тоннажа',
            'price' => 'Стоимость',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }

    /**
     * Gets query for [[Month]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMonth()
    {
        return $this->hasOne(Month::className(), ['id' => 'month_id']);
    }

    /**
     * Gets query for [[Weight]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWeight()
    {
        return $this->hasOne(Weight::className(), ['id' => 'weight_id']);
    }
}
