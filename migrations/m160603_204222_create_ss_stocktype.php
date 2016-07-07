<?php

use yii\db\Migration;

/**
 * Handles the creation for table `ss_stocktype`.
 */
class m160603_204222_create_ss_stocktype extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ss_stocktype', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(250),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('ss_stocktype');
    }
}
