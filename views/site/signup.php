<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

?>

<div class = "row mb-3 mt-3 offset-4 pt-5">
    <?php $form = ActiveForm::begin() ?>
    <h1>Регистрация</h1>
    <br>
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php $form = ActiveForm::end() ?>
</div>