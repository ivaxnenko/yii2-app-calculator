<?php

namespace app\models;

use yii\base\Model;


class SignupForm extends Model
{
    public $username;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password'],'required' , 'message' => 'Заполните поле'],
            ['username', 'unique', 'targetClass' => User::className() , 'message' => 'Данный логин уже занят']
        ];
    }

    /**
     * @return array the label names.
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль'
        ];
    }
}