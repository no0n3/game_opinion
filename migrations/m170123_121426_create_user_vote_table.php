<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class m170123_121426_create_user_vote_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('user_update_votes', [
            'user_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'update_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'UNIQUE(user_id, update_id)',
            'FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY (update_id) REFERENCES `update`(id) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('user_update_votes');
    }
}
