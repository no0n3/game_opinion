<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

//AppAsset::register($this);

$navItems = [
    ['label' => 'Home', 'url' => ['/game/index']],
    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
];

if (Yii::$app->user->isGuest) {
    $navItems[] = ['label' => 'Login', 'url' => ['/site/login'], 'options' => ['rel' => 'nofollow']];
    $navItems[] = ['label' => 'Sign Up', 'url' => ['/site/sign-up'], 'options' => ['rel' => 'nofollow']];
} else {
    $navItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php if (isset($this->params['json_ld'])) : ?>
    <script type="application/ld+json">
    <?= $this->params['json_ld'] ?>
    </script>
    <?php endif; ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => 
            $navItems
        ,
    ]);
    NavBar::end();
    ?>

    <div class="container1">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="col-sm-6">&copy; 
            <?php if (!empty(\Yii::$app->params['creatorSite'])) : ?>
                <a href="<?= \Yii::$app->params['creatorSite'] ?>"><?= \Yii::$app->params['creator'] ?></a>
            <?php else : ?>
                <?= \Yii::$app->params['creator'] ?>
            <?php endif; ?>
            <?= date('Y') ?></div>
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
            <div>
                <a href="<?= yii\helpers\Url::to([
                    'site/about'
                 ]) ?>">About</a>
            </div>
            <div>
                <a href="<?= yii\helpers\Url::to([
                    'site/contact'
                 ]) ?>">Contact</a>
            </div>
        </div>
    </div>
</footer>
<link href="/css/app.min.css" rel="stylesheet">
<script src="/js/all.min.js" type="text/javascript"></script>
<script>
    App.user.id = <?= Yii::$app->user->isGuest ? 'null' : Yii::$app->user->identity->id ?>;
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
