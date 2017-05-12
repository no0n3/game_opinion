<?php

namespace app\models\listing;

use Yii;
use yii\base\Model;
use app\models\Game;
use app\models\Update;
use yii\data\Pagination;
use app\models\UserUpdateVote;
use yii\data\ActiveDataProvider;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class UpdateList extends Model {

    private $game;
    private $updates;
    private $provider;
    private $votedUpdates = [];

    public function __construct($slug) {
        $this->game = Game::getGameBySlug($slug);

        if ($this->game) {
            $query = Update::find()
                ->where(['game_id' => $this->game->id])
                ->with(['user', 'image', 'game',])
                ->orderBy('created_at DESC')
                ;

            $pagination = new Pagination([
                'pageSize' => 6,
                'defaultPageSize' => 6,
                'totalCount' => $query->count(),
            ]);

            $this->provider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => $pagination,
            ]);

            $this->updates = $this->provider->getModels();

            if (!Yii::$app->user->isGuest) {
                $updateIds = [];

                foreach ($this->updates as $update) {
                    $updateIds[] = $update->id;
                }

                $this->votedUpdates = UserUpdateVote::find()
                    ->where([
                        'user_id' => Yii::$app->user->identity->id,
                        'update_id' => $updateIds,
                    ])
                    ->indexBy('update_id')
                    ->asArray()
                    ->all();
            }
        }
    }

    public function getGame() {
        return $this->game;
    }

        public function getUpdates() {
        return $this->updates;
    }

    public function getProvider() {
        return $this->provider;
    }

    public function getVotedUpdates() {
        return $this->votedUpdates;
    }

}
