<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class m170121_200055_add_game_update_table extends Migration {

    public function safeUp() {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('update', [
            'id' => Schema::TYPE_BIGINT . ' NOT NULL AUTO_INCREMENT',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'slug' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'upvotes' => Schema::TYPE_INTEGER . ' NOT NULL',
            'downvotes' => Schema::TYPE_INTEGER . ' NOT NULL',
            'comments' => Schema::TYPE_INTEGER . ' NOT NULL',
            'user_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'game_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'PRIMARY KEY (id)',
            'UNIQUE(slug, game_id)',
            'FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY (game_id) REFERENCES game(id) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable('update');
    }

}
