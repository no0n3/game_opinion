<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;

$voted = empty($voted) ? false : true;

?>

<div>
    <div>
        <h2 class="item-title item-title-view">
            <a class="item-link" href="<?= Url::to(['update/view', 'gameSlug' => $model->game->slug, 'updateSlug' => $model->slug]) ?>">
                <?= Html::encode($model->title) ?>
            </a>
        </h2>
    </div>
    <?php if (null !== $model->image) : ?>
    <div>
        <a class="item-link" href="<?= Url::to(['update/view', 'gameSlug' => $model->game->slug, 'updateSlug' => $model->slug]) ?>">
            <img src="<?= $model->image->getImageUrl() ?>" alt="<?= Html::encode($model->image->alt) ?>" style="width: 100%;">
        </a>
    </div>
    <?php endif; ?>
    <p>
        <?= Html::encode(StringHelper::truncate($model->description, 255)) ?>
    </p>
    <div class="votes-cont">
        <i class="update-upvote <?= $voted ? 'item-voted' : '' ?>" data-update-id="<?= $model->id ?>" data-voted="<?= $voted ? 'true' : 'false' ?>">
            <span><?= $model->upvotes ?></span> agree
        </i>
    </div>
</div>
