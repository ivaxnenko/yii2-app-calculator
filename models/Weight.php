<?php

namespace app\models;

use yii\db\ActiveRecord;


class Weight extends ActiveRecord
{
    /**
     * @return int
     */
    public function getId($name): int
    {
        $item = Weight::find()
        ->where(['count' => $name])
        ->select(['id'])
        ->asArray()
        ->all();

        return $item[0]['id'];
    }
}