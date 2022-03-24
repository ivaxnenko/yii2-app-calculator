<?php

/** @var yii\web\View $this */

use yii\widgets\ActiveForm;
use app\modules\admin\models\Month;
use app\modules\admin\models\Weight;
use app\modules\admin\models\Material;
use yii\helpers\ArrayHelper;

$this->title = 'Калькулятор стоимости грузоперевозок';
?>

<div class="site-index pt-5 pb-5">
    <div class="row mb-3 mt-3">
        <div class="col-md-4 offset-md-4 h2">
            Калькулятор стоимости грузоперевозки
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-2">
            <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col">
                        <?= $form->field($model, 'material')->dropDownList(
                            ArrayHelper::map(Material::find()->all(), 'id','name'))
                            ->label('Сырье') ?>
                    </div>
                    <div class="col">
                        <?= $form->field($model, 'month')->dropDownList(
                            ArrayHelper::map(Month::find()->all(), 'id','name'))
                            ->label('Месяц') ?>
                    </div>
                    <div class="col">
                        <?= $form->field($model, 'weight')->dropDownList(
                            ArrayHelper::map(Weight::find()->all(), 'id','count'))
                            ->label('Тоннаж') ?>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-md-4 offset-md-4">
                        <button type="submit" class="btn btn-primary" name="button">Рассчитать</button>
                    </div>
                </div>
            <?php $form = ActiveForm::end(); ?>
        </div>
    </div>
    <?php 
        if ($model->load(Yii::$app->request->post())) : 
    ?>
    <div class="row mt-3">
        <div class="col-md-4 offset-md-2">
            <table class="table">
                <tr>
                    <td></td>
                    <?php
                        foreach (ArrayHelper::map(Month::find()->all(), 'id','name') as $key => $value) {
                            echo "<td>{$value}</td>";
                        }
                    ?>
                </tr>
                <?php
                    $temp = 0;
                    for ($i = 0; $i<4; $i++) {
                        echo "<tr>";
                        $helpTemp = $temp;
                        $weight = 25 * ($i+1);
                        echo "<td>{$weight}</td>";
                        for ($j = 0; $j<6;$j++) {
                            if ($weight == $model['weight']*25 && $model['month'] == $model['table'][$helpTemp]['month_id']) {
                                echo "<td class=\"table-info\">{$model['table'][$helpTemp]['price']}</td>";
                            } else {
                                echo "<td>{$model['table'][$helpTemp]['price']}</td>";
                            }
                            $helpTemp+=4;
                        };
                        echo "</tr>";
                        $temp +=1;
                    };
                ?>

            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4 offset-md-4">
            <span class="border p-3 border-primary border-5 rounded-pill">
                Цена составит: <?= $model['tprice'] ?>
            </span>
        </div>
    </div>
    <?php endif;?>
</div>