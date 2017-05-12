<?php

namespace app\components\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\models\Game;
use app\models\Update;

class SlugBehavior extends Behavior {

    public $relIds = [];

    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'generateSlug',
        ];
    }

    public function generateSlug($event) {
        if (!($this->owner instanceof ActiveRecord) || !$this->owner->hasAttribute('slug')) {
            return;
        }

        $titleProp = null;

        if ($this->owner instanceof Game) {
            $titleProp = 'name';
        } else if ($this->owner instanceof Update) {
            $titleProp = 'title';
        } else {
            $this->owner->slug = null;
            return;
        }

        $owner = $this->owner;

        $slug = strtolower(trim($owner->$titleProp));
//        $slug = preg_replace('/[\s\:]+/', '-', $slug);
        $slug = preg_replace('/[^\wа-яА-Я]+/', '-', $slug);

        $additionalAttrs = [];
        foreach ($this->relIds as $relId) {
            $additionalAttrs[$relId] = $owner->$relId;
        }

        $owner->slug = $this->checkSlug($slug, 0, $additionalAttrs);
    }

    private function checkSlug($slug, $i = 0, $additionalAttrs) {
        $tmpSlug = 0 === $i ? $slug : "{$slug}-$i";

        $owner = $this->owner;
        $class = $owner::className();

        $where = ['slug' => $tmpSlug];

        $result = $class::find()
            ->where(array_merge($where, $additionalAttrs))
            ->asArray()
            ->one();

        if ($result) {
            return $this->checkSlug($slug, $i + 1, $additionalAttrs);
        }

        return $tmpSlug;
    }

}
