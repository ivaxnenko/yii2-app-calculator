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

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return[
            [['material', 'month', 'weight'], 'safe'],
        ];
    }
}