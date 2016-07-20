<?php

use yii\db\Migration;

class m160720_131357_add_auth_key_column_ss_user extends Migration
{
    public function up()
    {
        $this->addColumn('ss_user', 'auth_key', 'VARCHAR(255)');
    }

    public function down()
    {
        echo "m160720_131357_add_auth_key_column_ss_user cannot be reverted.\n";

        return false;
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
