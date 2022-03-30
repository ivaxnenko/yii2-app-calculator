<?php

namespace app\models;

use yii\db\ActiveRecord;

class Material extends ActiveRecord
{
    /**
     * @return int
     */
    public function getId($name): int
    {
        $item = Material::find()
        ->where(['name' => $name])
        ->select(['id'])
        ->asArray()
        ->all();

        return $item[0]['id'];
    }
}