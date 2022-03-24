<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Month;
use app\modules\admin\models\User;
use app\modules\admin\models\Weight;
use app\modules\admin\models\Material;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(
        ArrayHelper::map(User::find()->all(), 'id','username')
    ) ?>

    <?= $form->field($model, 'month')->dropDownList(
        ArrayHelper::map(Month::find()->all(), 'name','name')
    ) ?>

    <?= $form->field($model, 'type')->dropDownList(
        ArrayHelper::map(Material::find()->all(), 'name','name')
    ) ?>

    <?= $form->field($model, 'weight')->dropDownList(
        ArrayHelper::map(Weight::find()->all(), 'count','count')
    ) ?>

    <?= $form->field($model, 'tprice')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
