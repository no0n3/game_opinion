<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\components\behaviors\SlugBehavior;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class Game extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['updates', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'timestampBehavior' => TimestampBehavior::className(),
            'slug' => SlugBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'updates' => 'Updates',
            'created_at' => 'Created At',
        ];
    }

    public static function getAllGames() {
        $result = static::find()->joinWith('image')->all();

        return $result;
    }

    public static function getGameById($id, $asArray = false) {
        if (is_numeric($id)) {
            $query = static::find()
                ->where([
                    'id' => $id,
                ]);

            if ($asArray) {
                $query->asArray();
            }

            $result = $query->one();

            return $result;
        }

        return null;
    }

    public static function getGameBySlug($slug) {
        if ($slug) {
            $result = static::find()
                ->where([
                    'slug' => $slug,
                ])
                ->one();

            return $result;
        }

        return null;
    }

    public function getImage() {
        return $this->hasOne(Image::className(), ['rel_id' => 'id'])->where(['rel_type' => Image::REL_TYPE_GAME]);
    }

    public static function getAllAsArray() {
        $result = self::find()
            ->indexBy('id')
            ->asArray()
            ->all();

        return $result;
    }

}
