<?php

use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\Html;

?>

<div class="game-item">
    <figure>
        <a class="item-link" href="<?= Url::to(['game/view', 'slug' => $model->slug]) ?>">
            <img src="<?= $model->image->getImageUrlSmall() ?>" alt="<?= Html::encode($model->image->alt) ?>" style="width: 100%;">
        </a>
    </figure>
    <h2 class="item-title game-item-title">
        <a class="item-link" href="<?= Url::to(['game/view', 'slug' => $model->slug]) ?>">
            <?= Html::encode($model->name) ?>
        </a>
    </h2>
    <p><?= Html::encode(StringHelper::truncate($model->description, 255)) ?></p>
    <div class="votes-cont">
        <span class="update-upvote "><?= $model->updates ?> Updates</span>
    </div>
</div>
