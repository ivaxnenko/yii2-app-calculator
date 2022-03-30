<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;
use app\models\Price;
use yii\helpers\ArrayHelper;
use app\models\Material;
use app\models\Month;
use app\models\Weight;


class CalculateController extends Controller
{
    /**
     * @return int Exit code
     */
    public function actionIndex()
    {
        echo "Калькулятор грузоперевозок\n";
        
        $material = Console::select('Выберите сырье:',ArrayHelper::map(Material::find()->select(['id','name'])->all(), 'name','id'));
        $month = Console::select('Выберите месяц:',ArrayHelper::map(Month::find()->select(['id','name'])->all(), 'name','id'));
        $weight = Console::select('Выберите тоннаж',ArrayHelper::map(Weight::find()->select(['id','count'])->all(), 'count','id'));
       
        $price = Price::findOne([
            'material_id' => Material::getId($material),
            'weight_id' => Weight::getId($weight),
            'month_id' => Month::getId($month),
        ]);

        Console::output("По выбранным параметрам цена составит:" . $price->price * $weight);
        
        return ExitCode::OK;
    }
}
