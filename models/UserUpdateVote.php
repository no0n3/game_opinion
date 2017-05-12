<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class UserUpdateVote extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user_update_votes';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'update_id'], 'required'],
            [['user_id', 'update_id'], 'integer'],
            [['user_id', 'update_id'], 'unique', 'targetAttribute' => ['user_id', 'update_id'], 'message' => 'The combination of User ID and Update ID has already been taken.'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['update_id'], 'exist', 'skipOnError' => true, 'targetClass' => Update::className(), 'targetAttribute' => ['update_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'user_id' => 'User ID',
            'update_id' => 'Update ID',
        ];
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
    public function getUpdate() {
        return $this->hasOne(Update::className(), ['id' => 'update_id']);
    }

    /**
     * 
     * @param integer $userId
     * @param integer $updateId
     * @return \app\models\UserUpdateVote|null The created vote or NULL if none is found.
     */
    public static function getOne($userId, $updateId) {
        if (!is_numeric($userId) || !is_numeric($updateId)) {
            return null;
        }

        $result = static::find()
            ->where([
                'user_id' => $userId,
                'update_id' => $updateId,
            ])
            ->one();

        return $result;
    }

    /**
     * 
     * @param integer $userId
     * @param integer $updateId
     * @return \app\models\UserUpdateVote|null The created vote or NULL on failure.
     */
    public static function create($userId, $updateId) {
        if (!is_numeric($userId) || !is_numeric($updateId)) {
            return null;
        }

        $vote = new static([
            'user_id' => $userId,
            'update_id' => $updateId,
        ]);

        if ($vote->save()) {
            return $vote;
        }

        return null;
    }

}
