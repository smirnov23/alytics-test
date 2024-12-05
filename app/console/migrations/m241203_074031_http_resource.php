<?php

use yii\db\Migration;

/**
 * Class m241203_074031_http_resource
 */
class m241203_074031_http_resource extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%http_resource}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull()->unique(),
            'attempt_frequency' => $this->tinyInteger()->notNull()->defaultValue(1),
            'attempt_limit' => $this->bigInteger()->notNull()->defaultValue(0),
            'delay' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%http_resource}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241203_074031_http_resources cannot be reverted.\n";

        return false;
    }
    */
}
