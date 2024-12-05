<?php

use yii\db\Migration;

/**
 * Class m241203_074709_attempt
 */
class m241203_074709_attempt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attempt}}', [
            'id' => $this->primaryKey(),
            'http_resource_id' => $this->integer()->notNull(),
            'http_code' => $this->smallInteger()->notNull(),
            'response' => $this->text()->notNull(),
            'number' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
        ]);

        $this->createIndex(
            'idx-attempt-http_resource_id',
            'attempt',
            'http_resource_id'
        );

        $this->addForeignKey(
            'fk-attempt-http_resource_id',
            'attempt',
            'http_resource_id',
            'http_resource',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%attempt}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241203_074709_attempts cannot be reverted.\n";

        return false;
    }
    */
}
