<div class="container mt-5">
    <?php if (!\Yii::$app->user->isGuest) : ?>
        <div class="pb-3">
            <a href="<?= yii\helpers\Url::to(['/site/orders']) ?>">
                <button type="submit" class="btn btn-primary" name="button">История рассчетов</button>
            </a>
        </div>
        <div class="pb-3">
            <a href="<?= yii\helpers\Url::to(['/site/logout']) ?>">
                <button type="submit" class="btn btn-primary" name="button">Выход (<?= \Yii::$app->user->identity['username'] ?>)</button>
            </a>
        </div>
    <?php else : ?>
        <div class="pb-3">
            <a href="<?= yii\helpers\Url::to(['/site/signup']) ?>">
                <button type="submit" class="btn btn-primary" name="button">Регистрация</button>
            </a>
        </div>
        <div class="pb-3">
            <a href="<?= yii\helpers\Url::to(['/site/login']) ?>">
                <button type="submit" class="btn btn-primary" name="button">Вход</button>
            </a>
        </div>
    <?php endif ?>
    <div>
        <a href="<?= yii\helpers\Url::to(['/site/index']) ?>">
            <button type="submit" class="btn btn-primary" name="button">На главную</button>
        </a>
    </div>
    <?php
    if (!\Yii::$app->user->isGuest)
        if (\Yii::$app->user->identity->getRole() == 'admin') : ?>
        <div class="mt-3">
            <a href="<?= yii\helpers\Url::to(['/admin']) ?>">
                <button type="submit" class="btn btn-primary" name="button">Админка</button>
            </a>
        </div>
    <?php endif ?>
</div>