<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%user}}`.
     */
    class m200607_113414_create_user_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('{{%user}}', [
                'id' => $this->primaryKey(),
                'phone' => $this->string()->notNull()->unique(),
                'email' => $this->string()->notNull()->unique(),
            ]);
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('{{%user}}');
        }
    }
