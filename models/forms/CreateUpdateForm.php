<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\Game;
use app\models\Update;
use app\models\Image;
use yii\web\UploadedFile;
use app\components\helpers\ImageHelper;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class CreateUpdateForm extends Model {

    public $title;
    public $description;
    public $image;
    public $imageRes;

    public function rules() {
        return [
            [['title', 'description'], 'required'],
            [['title', 'description'], 'string'],
            ['image', 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 10],
        ];
    }

    /**
     * 
     * @param type $gameId
     * @param type $userId
     * @return boolean
     */
    public function createUpdate($gameId, $userId) {
        if (!$this->validate()) {
            return false;
        }

        $game = Game::getGameById($gameId);

        if (null === $game) {
            return false;
        }

        $update = Update::create([
            'game_id' => $gameId,
            'user_id' => $userId,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        if (null === $update) {
            return false;
        }

        $game->updates++;
        $game->save();

        $this->image = UploadedFile::getInstance($this, 'image');

        if ($this->validate() && null !== $this->image) {
            $imgName = $update->id . '-' . Image::REL_TYPE_UPDATE;

            $image = Image::create([
                'link' => '/images/update/'
                . $imgName . '-big.' . $this->image->extension,
                'name' => $imgName,
                'alt' => $update->title,
                'title' => $update->title,
                'rel_id' => $update->id,
                'rel_type' => Image::REL_TYPE_UPDATE,
            ]);

            $i = ImageHelper::scaleImage($this->image->tempName, 650, -1);

            imagejpeg($i,
                Yii::$app->params['path'] . 'web\images\update\\'
                . $imgName . '-big.jpg'
            );
        }

        return $update;
    }

    public function upload() {
        if ($this->validate()) {
            $this->image->saveAs('uploads/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }

}
