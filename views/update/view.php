<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use app\components\CStringHelper;

if ($update) {
$this->params['breadcrumbs'][] = [
    'url' => Url::to(['game/view', 'slug' => $update->game->slug]),
    'label' => Yii::t('app', $update->game->name)
];
$this->params['breadcrumbs'][] = Yii::t('app', $update->title);

$this->title = $update->title;

$this->registerLinkTag([
    'rel' => 'canonical',
    'href' => Url::to([
        'update/view', 
        'gameSlug' => $update->game->slug,
        'updateSlug' => $update->slug,
    ]),
]);

$this->registerMetaTag([
    'name' => 'description',
    'content' => CStringHelper::splitStripWords($update->description, 155),
]);

$this->registerMetaTag([
    'property' => 'og:type',
    'content' => 'article',
]);

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $update->title,
]);
if ($update->image) {
    $this->registerMetaTag([
        'property' => 'og:image',
        'content' => $update->image->getImageUrl(),
    ]);
    $this->registerMetaTag([
        'name' => 'twitter:image',
        'content' => $update->image->getImageUrl(),
    ]);
}
$this->registerMetaTag([
    'property' => 'og:description',
    'content' => StringHelper::truncate($update->description, 255),
]);

if (!empty($update->game->keywords) && is_string($update->game->keywords) && '' !== trim($update->game->keywords)) {
    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $update->game->keywords,
    ]);
}
?>

<div class="site-index update-item">
    <h1 class="item-title item-title-view">
            <?= Html::encode($update->title) ?>
    </h1>
    <?php if (null !== $update->image) : ?>
    <figure>
        <img src="<?= $update->image->getImageUrl() ?>" alt="<?= Html::encode($update->image->alt) ?>" style="width: 100%;">
    </figure>
    <?php endif; ?>
    <p>
        <?= Html::encode($update->description) ?>
    </p>
    <div class="votes-cont">
        <i class="update-upvote <?= $voted ? 'item-voted' : '' ?>" data-update-id="<?= $update->id ?>" data-voted="<?= $voted ? 'true' : 'false' ?>">
            <span><?= $update->upvotes ?></span> agree
        </i>
    </div>

</div>
<?php } else { ?>
<div class="site-index update-item">
    <div>The update that you're looking for doesn't exist.</div>
</div>
<?php } ?>

<?php

$upvoteUrl = Url::to([
    'update/ajax-upvote',
]);
$downvoteUrl = Url::to([
    'update/ajax-downvote',
]);

$this->registerJs(<<<JS

$(function() {
    App.update.init({
        'upvoteUrl' : '$upvoteUrl',
        'downvoteUrl' : '$downvoteUrl',
        
    });
});

JS
);
