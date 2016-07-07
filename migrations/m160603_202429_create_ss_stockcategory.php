<?php

use yii\db\Migration;

/**
 * Handles the creation for table `ss_stockcategory`.
 */
class m160603_202429_create_ss_stockcategory extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ss_stockcategory', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(155),
            'parentId' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('ss_stockcategory');
    }
}
