<?php

namespace app\models;

use yii\db\ActiveRecord;

class Orders extends ActiveRecord
{
    /*
    * @return void
    */
    public function loadValues($values):void
    {
        $this->user_id = \Yii::$app->user->identity->id;
        $this->type = Material::findOne(['id' => $values['material']])['name'];
        $this->weight = Weight::findOne(['id' => $values['weight']])['count'];
        $this->month = Month::findOne(['id' => $values['month']])['name'];
        $this->price = $values['tprice'];
        $this->tprice = $values['price']['price'];
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
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }
}