<?php

/** @var yii\web\View $this */
/** @var string $content */
?>

<div class="container pt-5">
    <h1>Админ панель</h1>
    <div>
            <a href="<?= yii\helpers\Url::to(['/admin/user']) ?>">
                <button type="submit" class="btn btn-primary" name="button">Пользователи</button>
            </a>

            <a href="<?= yii\helpers\Url::to(['/admin/orders']) ?>">
                <button type="submit" class="btn btn-primary" name="button">Заказы</button>
            </a>

            <a href="<?= yii\helpers\Url::to(['/admin/material']) ?>">
                <button type="submit" class="btn btn-primary" name="button">Сырье</button>
            </a>

            <a href="<?= yii\helpers\Url::to(['/admin/weight']) ?>">
                <button type="submit" class="btn btn-primary" name="button">Тоннаж</button>
            </a>

            <a href="<?= yii\helpers\Url::to(['/admin/month']) ?>">
                <button type="submit" class="btn btn-primary" name="button">Месяц</button>
            </a>
        
            <a href="<?= yii\helpers\Url::to(['/admin/price']) ?>">
                <button type="submit" class="btn btn-primary" name="button">Цены</button>
            </a>
    </div>
</div>