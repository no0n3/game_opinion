<?php

namespace app\commands;

use Yii;
use SimpleXMLElement;
use yii\console\Controller;
use app\models\Game;
use app\models\Update;
use yii\helpers\Url;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class SitemapController extends Controller {

    public function actionGenerateXml() {
        $xml = new SimpleXMLElement('<urlset/>');
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xml->addAttribute('xmlns:xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');

        foreach (Game::find()->with('image')->batch(100) as $games) {
            foreach ($games as $game) {
                $urlNode = $xml->addChild('url');
                $urlNode->addChild('loc', Yii::$app->params['siteUrl'] . '/game/' . $game->slug);
                $urlNode->addChild('lastmod', date('Y-m-d', $game->updated_at));
                $urlNode->addChild('changefreq', 'monthly');
                $urlNode->addChild('priority', '0.1');

                $imgNode = $urlNode->addChild('image:image:image');
                $imgNode->addChild('image:image:loc', $game->image->getImageUrl());
            }
        }

        foreach (Update::find()->with(['game', 'image'])->batch(100) as $updates) {
            foreach ($updates as $update) {
                $game = $update->game;

                $urlNode = $xml->addChild('url');
                $urlNode->addChild('loc', Yii::$app->params['siteUrl'] . '/game/' . $game->slug . '/' . $update->slug);
                $urlNode->addChild('lastmod', date('Y-m-d', $update->updated_at));
                $urlNode->addChild('changefreq', 'weekly');
                $urlNode->addChild('priority', '0.2');

                if (null !== $update->image) {
                    $imgNode = $urlNode->addChild('image:image:image');
                    $imgNode->addChild('image:image:loc', $update->image->getImageUrl());
                }
            }
        }

        $xml->asXML(__DIR__ . '/../web/sitemap.xml');
    }

}
