<?php

use yii\db\Migration;

/**
 * Handles the creation for table `ss_confirm`.
 * Has foreign keys to the tables:
 *
 * - `ss_user`
 */
class m160603_213840_create_ss_confirm extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ss_confirm', [
            'id' => $this->primaryKey(11),
            'link' => $this->string(50),
            'userId' => $this->integer(11),
            'sendDate' => $this->integer(11),
        ]);

        // creates index for column `userId`
        $this->createIndex(
            'idx-ss_confirm-userId',
            'ss_confirm',
            'userId'
        );

        // add foreign key for table `ss_user`
        $this->addForeignKey(
            'fk-ss_confirm-userId',
            'ss_confirm',
            'userId',
            'ss_user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `ss_user`
        $this->dropForeignKey(
            'fk-ss_confirm-userId',
            'ss_confirm'
        );

        // drops index for column `userId`
        $this->dropIndex(
            'idx-ss_confirm-userId',
            'ss_confirm'
        );

        $this->dropTable('ss_confirm');
    }
}
