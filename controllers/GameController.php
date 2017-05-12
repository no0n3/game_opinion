<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\listing\UpdateList;
use app\models\listing\GameList;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class GameController extends Controller {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $gameList = new GameList();

        return $this->render('index', [
            'games' => $gameList->games,
            'provider' => $gameList->provider,
        ]);
    }

    public function actionView($slug) {
        $list = new UpdateList($slug);

        if ($list->game) {
            return $this->render('view', [
                'game' => $list->game,
                'updates' => $list->updates,
                'provider' => $list->provider,
                'votedUpdates' => $list->votedUpdates,
            ]);
        } else {
            Yii::$app->response->statusCode = 404;

            return $this->render('view', [
                'game' => null,
            ]);
        }
    }

}
