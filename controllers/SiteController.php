<?php

namespace app\controllers;

use app\models\Complete;
use app\models\Material;
use app\models\Month;
use app\models\Price;
use yii\web\Controller;
use app\models\Weight;
use Symfony\Component\Console\Input\ArrayInput;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
      
    public function actionIndex()
    {
        $month = Month::find()->all();
        $material = Material::find()->all();
        $weight = Weight::find()->all();
        $currentPrice = null;
        $currentTable = null;

        $material  = ArrayHelper::map($material,'id','name');
        $month  = ArrayHelper::map($month,'id','name');
        $weight  = ArrayHelper::map($weight,'id','count');

        $model = new Complete();

        $model->attributes = \Yii::$app->request->post('Complete');

        if ($model->load(\Yii::$app->request->post()))
        {
            $price = Price::findOne([
                'material_id' => $model['material'],
                'weight_id' => $model['weight'],
                'month_id' => $model['month'],
            ]);

            $table = Price::findAll([
                'material_id' => $model['material']
            ]);

            $currentTable = ArrayHelper::toArray($table);
            $currentPrice = $price['price'] * 25 * $model['weight'];
        }
        

        return $this->render('index',compact('month','material','weight', 'model','currentPrice','currentTable'));
    }
}
