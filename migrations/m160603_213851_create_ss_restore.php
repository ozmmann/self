<?php

use yii\db\Migration;

/**
 * Handles the creation for table `ss_restore`.
 * Has foreign keys to the tables:
 *
 * - `ss_user`
 */
class m160603_213851_create_ss_restore extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ss_restore', [
            'id' => $this->primaryKey(11),
            'link' => $this->string(50),
            'userId' => $this->integer(11),
            'sendDate' => $this->integer(11),
        ]);

        // creates index for column `userId`
        $this->createIndex(
            'idx-ss_restore-userId',
            'ss_restore',
            'userId'
        );

        // add foreign key for table `ss_user`
        $this->addForeignKey(
            'fk-ss_restore-userId',
            'ss_restore',
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
            'fk-ss_restore-userId',
            'ss_restore'
        );

        // drops index for column `userId`
        $this->dropIndex(
            'idx-ss_restore-userId',
            'ss_restore'
        );

        $this->dropTable('ss_restore');
    }
}
