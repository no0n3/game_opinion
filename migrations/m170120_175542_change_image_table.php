<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class m170120_175542_change_image_table extends Migration {

    public function safeUp() {
        $this->addColumn('image', 'name', Schema::TYPE_STRING . ' AFTER `rel_type`');
        $this->addColumn('image', 'title', Schema::TYPE_STRING . ' AFTER `name`');
        $this->addColumn('image', 'alt', Schema::TYPE_STRING . ' AFTER `title`');
    }

    public function safeDown() {
        $this->dropColumn('image', 'name');
        $this->dropColumn('image', 'title');
        $this->dropColumn('image', 'alt');
    }

}
