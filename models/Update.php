<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\components\behaviors\SlugBehavior;

/**
 * This is the model class for table "update".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property integer $upvotes
 * @property integer $downvotes
 * @property integer $comments
 * @property string $user_id
 * @property string $game_id
 * @property integer $updated_at
 * @property integer $created_at
 *
 * @property User $user
 * @property Game $game
 *
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class Update extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'update';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'upvotes', 'downvotes', 'comments', 'user_id', 'game_id'], 'required'],
            [['description'], 'string'],
            [['upvotes', 'downvotes', 'comments', 'user_id', 'game_id', 'updated_at', 'created_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'timestampBehavior' => TimestampBehavior::className(),
            'slug' => [
                'class' => SlugBehavior::className(),
                'relIds' => [
                    'game_id',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'upvotes' => 'Upvotes',
            'downvotes' => 'Downvotes',
            'comments' => 'Comments',
            'user_id' => 'User ID',
            'game_id' => 'Game ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function getImage() {
        return $this->hasOne(Image::className(), ['rel_id' => 'id'])->where(['rel_type' => Image::REL_TYPE_UPDATE]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame() {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }

    /**
     * 
     * @param array $data The model data to be populated.
     * @return \app\model\Update|null The created update or NULL on failure.
     */
    public static function create(array $data) {
        $data['upvotes'] = $data['downvotes'] = $data['comments'] = 0;

        $update = new static($data);

        if ($update->save()) {
            return $update;
        }

        return null;
    }

    private static function checkSlug($slug, $gameId, $i = 0) {
        $tmpSlug = 0 === $i ? $slug : "{$slug}-$i";

        $result = static::find()
            ->where([
                'slug' => $tmpSlug,
                'game_id' => $gameId,
            ])
            ->asArray()
            ->one();

        if ($result) {
            return static::checkSlug($slug, $gameId, $i + 1);
        }

        return $tmpSlug;
    }

    public static function findByGame($gameId) {
        
        $result = static::find()->joinWith('image')->all();

        return $result;
    }

    public static function getBySlug($slug, $gameSlug) {
        if ($slug) {
            $result = static::find()
                ->innerJoin('game', 
                    Game::tableName() . '.id = `' . self::tableName() . '`.game_id'
                )
                ->where([
                    self::tableName() . '.slug' => $slug,
                    Game::tableName() . '.slug' => $gameSlug,
                ])
                ->one();

            return $result;
        }

        return null;
    }

    public static function upvote($updateId, $userId) {
        $vote = UserUpdateVote::getOne($userId, $updateId);

        if ($vote) {
            return false;
        }

        $vote = UserUpdateVote::create($userId, $updateId);

        if ($vote && $vote->update) {
            $vote->update->upvotes++;

            return $vote->update->save() ? true : false;
        }

        return false;
    }

    public static function downvote($updateId, $userId) {
        $vote = UserUpdateVote::getOne($userId, $updateId);

        if ($vote && $vote->update) {
            $vote->update->upvotes--;

            if (0 > $vote->update->upvotes) {
                $vote->update->upvotes = 0;
            }

            return ($vote->delete() && $vote->update->save()) ? true : false;
        }

        return false;
    }

}
