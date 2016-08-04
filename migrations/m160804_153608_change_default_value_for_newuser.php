<?php

use yii\db\Migration;

class m160804_153608_change_default_value_for_newuser extends Migration
{
    public function up()
    {
        $this->alterColumn('ss_user', 'status', "ENUM('ACTIVE', 'INACTIVE', 'BLOCKED') DEFAULT 'ACTIVE'");
    }

    public function down()
    {
        $this->alterColumn('ss_user', 'status', "ENUM('ACTIVE', 'INACTIVE', 'BLOCKED') DEFAULT 'INACTIVE'");
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
