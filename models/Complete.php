<?php

namespace app\models;

use yii\base\Model;

class Complete extends Model
{
    public $material;
    public $month;
    public $weight;
    public $table;
    public $price;
    public $tprice;
    public $distance;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'distance' => 'Расстояние'
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return[
            [['material', 'month', 'weight'], 'safe'],
            ['distance', 'required', 'message' => 'Заполните данное поле'],
            ['distance', 'integer', 'min' => 1, 'message' => 'Значение должно быть числом'],
        ];
    }
}