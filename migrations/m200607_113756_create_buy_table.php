<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%buy}}`.
     */
    class m200607_113756_create_buy_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('{{%buy}}', [
                'id' => $this->primaryKey(),
                'product' => $this->string()->notNull(),
                'price' => $this->integer()->notNull(),
            ]);
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('{{%buy}}');
        }
    }
