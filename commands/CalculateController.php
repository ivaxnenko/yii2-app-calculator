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
use app\components\Command;
use app\components\CommandContext;


class CalculateController extends Controller
{
    /**
     * @return int Exit code
     */
    public function actionIndex()
    {
        $cmd = new Command;
        $context = new CommandContext;

        echo "Калькулятор грузоперевозок\n";
        
        $material = Console::select('Выберите сырье:',ArrayHelper::map(Material::find()->select(['id','name'])->all(), 'name','id'));
        $month = Console::select('Выберите месяц:',ArrayHelper::map(Month::find()->select(['id','name'])->all(), 'name','id'));
        $weight = Console::select('Выберите тоннаж',ArrayHelper::map(Weight::find()->select(['id','count'])->all(), 'count','id'));
        
        $distance = Console::prompt(
                        'Введите расстояние',
                        [
                            'required' => true,
                            'validator' => function($input, &$error) {
                                if (($input == intval($input)) && ($input > 0)) {
                                    return true;
                                }
                                $error = 'Введенное значение должно быть числом больше 0!!!';
                                return false;
                            }
                        ]);
        
        $price = Price::findOne([
            'material_id' => Material::getId($material),
            'weight_id' => Weight::getId($weight),
            'month_id' => Month::getId($month),
        ]);

        $context->price = $price->price * $weight;
        $context->distance = $distance;

        $cmd->calculatePriceByDistance($context);

        Console::output("По выбранным параметрам цена составит:" . $context->result);
        
        return ExitCode::OK;
    }
}
