<?php

/** @var yii\web\View $this */

use yii\grid\GridView;

$this->title = 'Ваши расчеты';
?>

<div class="site-index pt-5 pb-5">
    <div class="row mb-3 mt-3">
        <div class="col-md-5 offset-md-5 h2">
            Ваши расчеты
        </div>
    <div class="row mt-3">
        <div class="col-md-4 offset-md-3">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'month',
            'type',
            'weight',
            'tprice',
            'distance',
            'price',
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'dd.MM.YYYY HH:mm:ss'],
            ],
        ],
    ]); ?>
        </div>
    </div>
</div>