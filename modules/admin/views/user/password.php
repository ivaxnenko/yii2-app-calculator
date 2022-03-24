<?php
 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
 
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\ChangePasswordForm */
 
$this->title = Yii::t('app', 'Сменить пароль');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пароль'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-password-change">
 
    <h1><?= Html::encode($this->title) ?></h1>
 
    <div class="user-form">
 
        <?php $form = ActiveForm::begin(); ?>
 
        <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true])->label('Старый пароль') ?>
        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true])->label('Новый пароль') ?>
        <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true])->label('Повторите пароль') ?>
 
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
        </div>
 
        <?php ActiveForm::end(); ?>
 
    </div>
 
</div>