<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use app\components\CStringHelper;

if ($game) :
$this->params['breadcrumbs'][] = Yii::t('app', $game->name);

$this->title = $game->name;

$this->registerLinkTag([
    'rel' => 'canonical',
    'href' => Url::to([
        'game/view', 
        'slug' => $game->slug,
    ]),
]);

$this->registerMetaTag([
    'property' => 'og:type',
    'content' => 'article',
]);

$this->registerMetaTag([
    'name' => 'description',
    'content' => CStringHelper::splitStripWords($game->description, 155),
]);

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $game->name,
]);
$this->registerMetaTag([
    'property' => 'og:image',
    'content' => $game->image->getImageUrl(),
]);
$this->registerMetaTag([
    'name' => 'twitter:image',
    'content' => $game->image->getImageUrl(),
]);
$this->registerMetaTag([
    'property' => 'og:description',
    'content' => StringHelper::truncate($game->description, 255),
]);

if (!empty($game->keywords) && is_string($game->keywords) && '' !== trim($game->keywords)) {
    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $game->keywords,
    ]);
}

?>

<div class="site-index">
<div class="update-item">
    <h1 class="item-title item-title-view">
        <?= Html::encode($game->name) ?>
    </h1>
    <figure>
        <img src="<?= $game->image->getImageUrl() ?>" alt="<?= Html::encode($game->image->alt) ?>" style="width: 100%;">
    </figure>
    <p>
        <?= Html::encode($game->description) ?>
    </p>
    <div>
        <div class="game-updates-cont">
            <span class="update-upvote"><?= $game->updates ?> updates</span>
        </div>
    </div>
</div>

    <div style="margin-top:30px;">
        Browse updates for <?= Html::encode($game->name) ?>.
        <?php if (!\Yii::$app->user->isGuest) : ?>
            <a href="<?= Url::to(['update/create', 'game_id' => $game->id]) ?>" class="btn btn-primary" rel="nofollow">post update for the game</a>
        <?php else : ?>
            <a href="<?= Url::to(['site/login', 'game_id' => $game->id]) ?>" class="btn btn-primary" rel="nofollow">Login to post an update for this game</a>
        <?php endif; ?>
    </div>

    <div id="game-update-items-cont" class="game-update-items">
        <?php foreach ($updates as $model) : ?>
            <div class="update-item">
            <?= $this->render('update_item', [
                'model' => $model,
                'voted' => !empty($votedUpdates[$model->id]),
            ]) ?>
            </div>
        <?php endforeach; ?>
        <div>
            <?= LinkPager::widget([
                'pagination' => $provider->pagination,
            ]); ?>
        </div>
        <?php ListView::widget([
            'dataProvider' => $provider,
            'itemView' => 'update_item',
            'itemOptions' => [
                'class' => 'update-item',
            ],
            'layout' => '<div class="game-item-cont">{items}</div>{pager}',
        ]) ?>
    </div>
</div>

<?php

$upvoteUrl = Url::to([
    'update/ajax-upvote',
]);

$upvoteUrl = Url::to([
    'update/ajax-upvote',
]);
$downvoteUrl = Url::to([
    'update/ajax-downvote',
]);

$this->registerJs(<<<JS
window.onload = function() {
    var ele = document.getElementById('game-update-items-cont');
    window.scrollTo(0, ele.offsetTop - 70);
}

$(function() {
    App.update.init({
        'upvoteUrl' : '$upvoteUrl',
        'downvoteUrl' : '$downvoteUrl',
    });
});

JS
);

else : ?>
<div class="site-index update-item">
    <div>The game that you're looking for doesn't exist.</div>
</div>
<?php endif; ?>
