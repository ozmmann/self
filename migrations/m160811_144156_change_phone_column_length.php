<?php

use yii\db\Migration;

class m160811_144156_change_phone_column_length extends Migration
{
    public function up()
    {
        $this->alterColumn('ss_user', 'phone', $this->string(22));
        $this->alterColumn('ss_user', 'secondPhone', $this->string(22));
    }

    public function down()
    {
        $this->alterColumn('ss_user', 'phone', $this->string(22));
        $this->alterColumn('ss_user', 'secondPhone', $this->string(22));
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
