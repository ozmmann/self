<?php

use yii\db\Migration;

/**
 * Handles the creation for table `ss_commission`.
 * Has foreign keys to the tables:
 *
 * - `ss_stockcategory`
 */
class m160603_202446_create_ss_commission extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ss_commission', [
            'id' => $this->primaryKey(11),
            'cityType' => 'ENUM("REGION", "GHOST") NOT NULL',
            'stockCategoryId' => $this->integer(11),
            'percent' => $this->float(),
            'fixed' => $this->float(),
            'free' => $this->float(),
        ]);

        // creates index for column `stockCategoryId`
        $this->createIndex(
            'idx-ss_commission-stockCategoryId',
            'ss_commission',
            'stockCategoryId'
        );

        // add foreign key for table `ss_stockcategory`
        $this->addForeignKey(
            'fk-ss_commission-stockCategoryId',
            'ss_commission',
            'stockCategoryId',
            'ss_stockcategory',
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
            'fk-ss_commission-stockCategoryId',
            'ss_commission'
        );

        // drops index for column `stockCategoryId`
        $this->dropIndex(
            'idx-ss_commission-stockCategoryId',
            'ss_commission'
        );

        $this->dropTable('ss_commission');
    }
}
