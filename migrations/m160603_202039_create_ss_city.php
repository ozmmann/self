<?php

use yii\db\Migration;

/**
 * Handles the creation for table `ss_city`.
 */
class m160603_202039_create_ss_city extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ss_city', [
            'id' => $this->primaryKey(11),
            'name' => $this->string(100),
            'notGhost' => 'tinyint(4)',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('ss_city');
    }
}
