<?php

use yii\db\Migration;

/**
 * Class m200217_064230_user
 */
class m200217_064230_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        
        // $this->createTable('users', [
        //     'id' => $this->primaryKey(),
        //     'username' => $this->string()->notNull()->unique(),
        //     'auth_key' => $this->string(32)->notNull(),
        //     'password_hash' => $this->string()->notNull(),
        //     'password_reset_token' => $this->string()->unique(),
        //     'email' => $this->string()->notNull()->unique(),
        //     'status' => $this->smallInteger()->notNull()->defaultValue(10),
        //     'created_at' => $this->integer()->notNull(),
        //     'updated_at' => $this->integer()->notNull(),
        // ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200217_064230_user cannot be reverted.\n";

        return false;
    }
    */
}
