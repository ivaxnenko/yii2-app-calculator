<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Month;
use app\modules\admin\models\Weight;
use app\modules\admin\models\Material;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Price */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'material_id')->dropDownList(
        ArrayHelper::map(Material::find()->select(['id','name'])->all(), 'id','name')
    ) ?>

    <?= $form->field($model, 'month_id')->dropDownList(
        ArrayHelper::map(Month::find()->select(['id','name'])->all(), 'id','name')
    ) ?>

    <?= $form->field($model, 'weight_id')->dropDownList(
        ArrayHelper::map(Weight::find()->select(['id','count'])->all(), 'id','count')
    ) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

