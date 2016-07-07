<?php

use yii\db\Migration;

/**
 * Handles the creation for table `ss_user`.
 * Has foreign keys to the tables:
 *
 * - `ss_stocktype`
 * - `ss_city`
 */
class m160603_212820_create_ss_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ss_user', [
            'id' => $this->primaryKey(11),
            'email' => $this->string(255),
            'password' => $this->string(100),
            'role' => "ENUM('PARTNER', 'MODERATOR', 'ADMIN') DEFAULT 'PARTNER'",
            'confirmed' => 'tinyint(4) DEFAULT 0',
            'status' => "ENUM('ACTIVE', 'INACTIVE', 'BLOCKED') DEFAULT 'INACTIVE'",
            'registrationDate' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'name' => $this->string(255),
            'phone' => $this->string(18),
            'secondPhone' => $this->string(18),
            'stockTypeId' => $this->integer(11),
            'cityId' => $this->integer(11),
            'inn' => $this->string(11),
            'site' => $this->string(100),
        ]);

        // creates index for column `stockTypeId`
        $this->createIndex(
            'idx-ss_user-stockTypeId',
            'ss_user',
            'stockTypeId'
        );

        // add foreign key for table `ss_stocktype`
        $this->addForeignKey(
            'fk-ss_user-stockTypeId',
            'ss_user',
            'stockTypeId',
            'ss_stocktype',
            'id',
            'CASCADE'
        );

        // creates index for column `cityId`
        $this->createIndex(
            'idx-ss_user-cityId',
            'ss_user',
            'cityId'
        );

        // add foreign key for table `ss_city`
        $this->addForeignKey(
            'fk-ss_user-cityId',
            'ss_user',
            'cityId',
            'ss_city',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `ss_stocktype`
        $this->dropForeignKey(
            'fk-ss_user-stockTypeId',
            'ss_user'
        );

        // drops index for column `stockTypeId`
        $this->dropIndex(
            'idx-ss_user-stockTypeId',
            'ss_user'
        );

        // drops foreign key for table `ss_city`
        $this->dropForeignKey(
            'fk-ss_user-cityId',
            'ss_user'
        );

        // drops index for column `cityId`
        $this->dropIndex(
            'idx-ss_user-cityId',
            'ss_user'
        );

        $this->dropTable('ss_user');
    }
}
