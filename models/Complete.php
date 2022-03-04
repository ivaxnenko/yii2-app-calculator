<?php

namespace app\models;

use yii\base\Model;

class Complete extends Model
{
    public $material;
    public $month;
    public $weight;

    public function rules()
    {
        return[
            [['material', 'month', 'weight'], 'safe'],
        ];
    }
}