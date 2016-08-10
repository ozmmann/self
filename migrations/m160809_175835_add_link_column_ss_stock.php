<?php

use yii\db\Migration;

class m160809_175835_add_link_column_ss_stock extends Migration
{
    public function up()
    {
        $this->addColumn('ss_stock', 'link', 'VARCHAR(255)');
    }

    public function down()
    {
        $this->dropColumn('ss_stock', 'link');
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
