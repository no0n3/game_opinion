<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "image".
 *
 * @property string $id
 * @property string $link
 * @property string $rel_id
 * @property integer $rel_type
 * @property integer $created_at
 *
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class Image extends ActiveRecord {
    const REL_TYPE_GAME = 1;
    const REL_TYPE_UPDATE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['rel_id', 'rel_type'], 'required'],
            [['rel_id', 'rel_type', 'created_at'], 'integer'],
            [['link'], 'string', 'max' => 255],
            [['link'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'timestampBehavior' => TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'rel_id' => 'Rel ID',
            'rel_type' => 'Rel Type',
            'created_at' => 'Created At',
        ];
    }

    public static function getImagesForGames($ids) {
        $result = Image::find()
            ->where([
                'rel_type' => self::REL_TYPE_GAME,
                'rel_id' => $ids,
            ])
            ->all();

        return $result;
    }

    public function getImageUrl() {
        return Yii::$app->params['siteUrl'] . '/images/' . $this->getFolderForRelType() . '/' . $this->name . '-big.jpg';
    }

    public function getImageUrlSmall() {
        return Yii::$app->params['siteUrl'] . '/images/' . $this->getFolderForRelType() . '/' . $this->name . '-small.jpg';
    }

    public static function create($data) {
        $img = new static($data);

        return $img->save() ? $img : null;
    }

    private function getFolderForRelType() {
        if (self::REL_TYPE_GAME == $this->rel_type) {
            return 'game';
        } else if (self::REL_TYPE_UPDATE == $this->rel_type) {
            return 'update';
        }

        return '';
    }

}
