<?php

/** @var yii\web\View $this */

use yii\bootstrap4\ActiveForm;

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
                        <?php 
                        echo $form->field($model, 'material')->dropDownList($material)->label('Сырье');
                       ?>
                    </div>
                    <div class="col">
                        <?php 
                            echo $form->field($model, 'month')->dropDownList($month)->label('Месяц');
                        ?>
                    </div>
                    <div class="col">
                        <?php 
                            echo $form->field($model, 'weight')->dropDownList($weight)->label('Тоннаж');
                        ?>
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
                    <td><?php echo $material[$model['material']] ?></td>
                    <?php
                        foreach ($month as $key => $value)
                        {
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
                            if ($weight == $model['weight']*25 && $model['month'] == $currentTable[$helpTemp]['month_id']) {
                                echo "<td class=\"table-info\">{$currentTable[$helpTemp]['price']}</td>";
                            } else {
                                echo "<td>{$currentTable[$helpTemp]['price']}</td>";
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
                Цена составит: <?= $currentPrice ?>
            </span>
        </div>
    </div>
    <?php endif;?>
</div>