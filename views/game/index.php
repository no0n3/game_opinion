<?php

use yii\helpers\StringHelper;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\helpers\Html;

$this->title = 'Browse games';
$description = 'Post updates and opinions for games.';

$page = $provider->pagination->getPage() + 1; // 0 based

if (1 === $page) {
    $this->registerLinkTag([
        'rel' => 'canonical',
        'href' => Url::to(['game/index']),
    ]);
}
if (1 < $page) {
    $this->registerLinkTag([
        'rel' => 'prev',
        'href' => Url::to(['game/index', 'page' => $page - 1]),
    ]);
}

if ($page < $provider->pagination->pageCount) {
    $this->registerLinkTag([
        'rel' => 'next',
        'href' => Url::to(['game/index', 'page' => $page + 1]),
    ]);
}

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $this->title,
]);
$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $description,
]);

$this->params['json_ld'] = <<<JS
{
      "@context": "http://schema.org/",
      "@type": "Recipe",
      "name": "Strawberry-Mango Mesclun Recipe",
      "image": "http://images.media-allrecipes.com/userphotos/600x600/1116471.jpg",
      "author": {
      "@type": "Person",
      "name": "scoopnana"
     },
     "datePublished": "2008-03-03",
     "description": "Mango, strawberries, and sweetened dried cranberries are a vibrant addition to mixed greens tossed with an oil and balsamic vinegar dressing.",
     "aggregateRating": {
       "@type": "AggregateRating",
       "ratingValue": "5",
       "reviewCount": "52"
     },
     "prepTime": "PT15M",
     "totalTime": "PT14M",
     "recipeYield": "12 servings",
     "nutrition": {
       "@type": "NutritionInformation",
       "servingSize": "1 bowl",
       "calories": "319 cal",
       "fatContent": "20.2 g"
     },
     "recipeIngredient": [
       "1/2 cup sugar",
       "3/4 cup canola oil",
       "1 teaspoon salt",
       "1/4 cup balsamic vinegar",
       "8 cups mixed salad greens",
       "2 cups sweetened dried cranberries",
       "1/2 pound fresh strawberries, quartered",
       "1 mango - peeled, seeded, and cubed",
       "1/2 cup chopped onion",
       "1 cup slivered almonds"
     ],
     "recipeInstructions": "\n1. Place the sugar, oil, salt, and vinegar in a jar with a lid. Seal jar, and shake vigorously to mix.\n2. In a large bowl, mix salad greens, sweetened dried cranberries, strawberries, mango, and onion. To serve, toss with dressing and sprinkle with almonds."
}
JS;

?>

<div class="site-index">
    <div class="games-index-cont">
        <h1>
            <?= Html::encode($this->title) ?>
        </h1>
        <p>
            <?= Html::encode($description) ?>
        </p>
    </div>

    <div class="container cont-x">
    <?php $i = 0; $x = 0; foreach ($provider->getModels() as $model) : ?>
        <?php if (0 === $i || 0 === $i % 3) : ?>
            <?php if (0 !== $i) : ?>
            </div>
            <?php $x--; endif; ?>
            <div class="row row-1">
        <?php $x++; endif; ?>

        <div class="col-sm-4"><?= $this->render('game_item', ['model' => $model]) ?></div>

        
    <?php $i++; endforeach; ?>
        <?php if ($x > 0) : ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="pagination-cont">
        <?= LinkPager::widget([
            'pagination' => $provider->pagination,
        ]); ?>
    </div>

</div>
