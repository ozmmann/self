<?php

use yii\db\Migration;

/**
 * Handles the creation for table `ss_stock`.
 * Has foreign keys to the tables:
 *
 * - `ss_stockcategory`
 * - `ss_user`
 */
class m160603_214003_create_ss_stock extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ss_stock', [
            'id' => $this->primaryKey(11),
            'categoryId' => $this->integer(),
            'userId' => $this->integer(11),
            'commissionType' => "ENUM('FREE', 'PERCENT', 'FIXED')",
            'commissionValue' => $this->float(),
            'status' => "ENUM('ACTIVE', 'INACTIVE', 'BLOCKED', 'FINISHED') DEFAULT 'INACTIVE'",
            'title' => $this->string(255),
            'description' => $this->text(),
            'discount' => $this->integer(11),
            'price' => $this->integer(11),
            'startDate' => $this->date(),
            'endDate' => $this->date(),
            'picture' => $this->string(255),
            'condition' => $this->text(),
            'organizer' => $this->text(),
            'location' => $this->text(),
        ]);

        // creates index for column `categoryId`
        $this->createIndex(
            'idx-ss_stock-categoryId',
            'ss_stock',
            'categoryId'
        );

        // add foreign key for table `ss_stockcategory`
        $this->addForeignKey(
            'fk-ss_stock-categoryId',
            'ss_stock',
            'categoryId',
            'ss_stockcategory',
            'id',
            'CASCADE'
        );

        // creates index for column `userId`
        $this->createIndex(
            'idx-ss_stock-userId',
            'ss_stock',
            'userId'
        );

        // add foreign key for table `ss_user`
        $this->addForeignKey(
            'fk-ss_stock-userId',
            'ss_stock',
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
        // drops foreign key for table `ss_stockcategory`
        $this->dropForeignKey(
            'fk-ss_stock-categoryId',
            'ss_stock'
        );

        // drops index for column `categoryId`
        $this->dropIndex(
            'idx-ss_stock-categoryId',
            'ss_stock'
        );

        // drops foreign key for table `ss_user`
        $this->dropForeignKey(
            'fk-ss_stock-userId',
            'ss_stock'
        );

        // drops index for column `userId`
        $this->dropIndex(
            'idx-ss_stock-userId',
            'ss_stock'
        );

        $this->dropTable('ss_stock');
    }
}
