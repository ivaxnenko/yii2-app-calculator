<?php

namespace app\models;

use yii\db\ActiveRecord;

class Month extends ActiveRecord
{
    /**
     * @return int
     */
    public function getId($name): int
    {
        $item = Month::find()
        ->where(['name' => $name])
        ->select(['id'])
        ->asArray()
        ->all();

        return $item[0]['id'];
    }
}