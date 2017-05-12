<?php

use app\models\Game;
use yii\db\Migration;
use yii\db\Schema;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class m170118_094401_init_db extends Migration {
    public function up() {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('user', [
            'id' => Schema::TYPE_BIGINT . ' NOT NULL AUTO_INCREMENT',
            'username' => Schema::TYPE_STRING . ' NOT NULL UNIQUE KEY',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL UNIQUE KEY',
            'role' => Schema::TYPE_STRING . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'PRIMARY KEY (id)',
        ], $tableOptions);

        $this->createTable('game', [
            'id' => Schema::TYPE_BIGINT . ' NOT NULL AUTO_INCREMENT',
            'name' => Schema::TYPE_STRING . ' NOT NULL UNIQUE KEY',
            'slug' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'keywords' => Schema::TYPE_STRING,
            'updates' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'PRIMARY KEY (id)',
        ], $tableOptions);

        $this->createTable('game_tag', [
            'id' => Schema::TYPE_BIGINT . ' NOT NULL AUTO_INCREMENT',
            'name' => Schema::TYPE_STRING . ' NOT NULL UNIQUE KEY',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'PRIMARY KEY (id)',
        ], $tableOptions);

        $this->createTable('game_tag_rel', [
            'game_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'tag_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'UNIQUE(game_id, tag_id)',
        ], $tableOptions);
    }

    public function down() {
        $this->dropTable('user');
        $this->dropTable('game');
        $this->dropTable('game_tag');
        $this->dropTable('game_tag_rel');
    }
}
