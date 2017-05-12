<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class m170119_140009_update_db extends Migration {
    public function up() {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('image', [
            'id' => Schema::TYPE_BIGINT . ' NOT NULL AUTO_INCREMENT',
            'rel_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'rel_type' => Schema::TYPE_INTEGER . ' NOT NULL',
            'link' => Schema::TYPE_STRING,
            'updated_at' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'PRIMARY KEY (id)',
        ], $tableOptions);

        $this->addColumn('game', 'website_url', Schema::TYPE_STRING . ' NOT NULL AFTER `description`');
        $this->addColumn('game', 'is_deleted', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0 AFTER `website_url`');
    }

    public function down() {
        $this->dropTable('image');

        $this->dropColumn('game', 'website_url');
    }
}
