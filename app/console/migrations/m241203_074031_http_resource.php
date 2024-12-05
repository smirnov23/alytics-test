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
            'fail_limit' => $this->bigInteger()->notNull()->defaultValue(0),
            'fail_delay' => $this->tinyInteger()->notNull()->defaultValue(1),
            'fails' => $this->bigInteger()->notNull()->defaultValue(0),
            'attempted_at' => $this->datetime(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
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
