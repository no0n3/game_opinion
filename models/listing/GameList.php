<?php

namespace app\models\listing;

use yii\base\Model;
use app\models\Game;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class GameList extends Model {

    private $games;
    private $provider;

    public function __construct() {
        $this->games = Game::getAllGames();

        $query = Game::find();
        $pagination = new Pagination([
            'pageSize' => 6,
            'totalCount' => $query->count(),
        ]);

        $this->provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination,
        ]);
    }

    public function getGames() {
        return $this->games;
    }

    public function getProvider() {
        return $this->provider;
    }

}
