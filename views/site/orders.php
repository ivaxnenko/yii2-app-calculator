<?php

/** @var yii\web\View $this */

$this->title = 'Ваши расчеты';
?>

<div class="site-index pt-5 pb-5">
    <div class="row mb-3 mt-3">
        <div class="col-md-5 offset-md-5 h2">
            Ваши расчеты
        </div>
    <div class="row mt-3">
        <div class="col-md-4 offset-md-3">
            <table class="table">
                <tr>
                    <td>Месяц</td>
                    <td>Сырье</td>
                    <td>Тоннаж</td>
                    <td>Стоимость за тонну</td>
                    <td>Общая стоимость</td>
                    <td>Дата расчета</td>
                </tr>
                <?php
                    foreach($orders as $key => $value)
                    {
                        $value = array_diff_key($value, ['id' => "xy",'user_id' => "xy", "updated_at" => "xy"]);
                        echo '<tr>';
                        foreach($value as $k => $v)
                                echo "<td>{$v}</td>";
                        echo '</tr>';
                    }
                ?>
            </table>
        </div>
    </div>
</div>