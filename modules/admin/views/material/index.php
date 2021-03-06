<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Material;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Сырье');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Создать'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'dd.MM.YYYY HH:mm:ss'],
                ],
            [
            'attribute' => 'updated_at',
            'format' =>  ['date', 'dd.MM.YYYY HH:mm:ss'],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Material $model) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
</div>

<a href="<?= yii\helpers\Url::to(['/admin']) ?>">
    <button type="submit" class="btn btn-primary" name="button">К админ панели</button>
</a>
