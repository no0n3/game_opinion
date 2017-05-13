<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$description = 'A web application for sharing game experience and opinions. Main purpose to demonstrade SEO for a website.';

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $this->title,
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $description,
]);

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::encode($description) ?>
        <br/>
        Created and maintained by 
        <?php if (!empty(\Yii::$app->params['creatorSite'])) : ?>
            <a href="<?= \Yii::$app->params['creatorSite'] ?>"><?= isset(\Yii::$app->params['creator']) ? \Yii::$app->params['creator'] : 'Velizar Ivanov' ?></a>
        <?php else : ?>
            <?= isset(\Yii::$app->params['creator']) ? \Yii::$app->params['creator'] : 'Velizar Ivanov' ?>
        <?php endif; ?>
        <br/>
        <?php if (!empty(\Yii::$app->params['creatorSite'])) : ?>
            For more information about the website check <a href="<?= \Yii::$app->params['creatorSite'] ?>projects.php#project-2">this</a>.
        <?php endif; ?>
    </p>

</div>
