<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Game;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use app\models\forms\CreateUpdateForm;
use app\models\Update;
use yii\helpers\Url;
use app\models\UserUpdateVote;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class UpdateController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['post', 'ajax-upvote', 'ajax-downvote'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'ajax-upvote' => ['post'],
                    'ajax-downvote' => ['post'],
                ],
            ],
        ];
    }

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
        $games = Game::getAllGames();

        $query = Game::find();
        $pagination = new Pagination([
            'pageSize' => 6,
            'totalCount' => $query->count(),
        ]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination,
        ]);

        return $this->render('index', [
            'games' => $games,
            'provider' => $provider,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionView() {
        $gameSlug = \Yii::$app->request->get('gameSlug');
        $updateSlug = \Yii::$app->request->get('updateSlug');

        $update = Update::getBySlug($updateSlug, $gameSlug);

        $voted = false;

        if (null === $update) {
            Yii::$app->response->statusCode = 404;
        } else {
            if (!Yii::$app->user->isGuest) {
                $vote = UserUpdateVote::getOne(Yii::$app->user->identity->id, $update->id);

                $voted = null === $vote ? false : true;
            }
        }

        return $this->render('view', [
            'update' => $update,
            'voted' => $voted,
        ]);
    }

    /**
     * @return string
     */
    public function actionCreate() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        }

        $gameId = \Yii::$app->request->get('game_id');

        $model = new CreateUpdateForm();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();

            try {
                $update = $model->createUpdate($gameId, \Yii::$app->user->identity->id);

                if ($update) {
                    $transaction->commit();

                    return $this->redirect(Url::to([
                        'update/view',
                        'updateSlug' => $update->slug,
                        'gameSlug' => $update->game->slug,
                    ]));
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionAjaxUpvote() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $success = false;

        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->identity->id;
            $updateId = Yii::$app->request->post('update_id');

            $transaction = Yii::$app->db->beginTransaction();

            try {
                $success = Update::upvote($updateId, $userId);

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        return [
            'success' => $success,
        ];
    }

    public function actionAjaxDownvote() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $success = false;

        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->identity->id;
            $updateId = Yii::$app->request->post('update_id');

            $transaction = Yii::$app->db->beginTransaction();

            try {
                $success = Update::downvote($updateId, $userId);

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        return [
            'success' => $success,
        ];
    }

}
