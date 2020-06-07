<?php

    use yii\db\Migration;

    /**
     * Handles adding columns to table `{{%buy}}`.
     * Has foreign keys to the tables:
     *
     * - `{{%user}}`
     */
    class m200607_120453_add_user_id_column_to_buy_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->addColumn('{{%buy}}', 'user_id', $this->integer()->notNull()->after('id'));

            // creates index for column `user_id`
            $this->createIndex(
                '{{%idx-buy-user_id}}',
                '{{%buy}}',
                'user_id'
            );

            // add foreign key for table `{{%user}}`
            $this->addForeignKey(
                '{{%fk-buy-user_id}}',
                '{{%buy}}',
                'user_id',
                '{{%user}}',
                'id',
                'CASCADE'
            );
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            // drops foreign key for table `{{%user}}`
            $this->dropForeignKey(
                '{{%fk-buy-user_id}}',
                '{{%buy}}'
            );

            // drops index for column `user_id`
            $this->dropIndex(
                '{{%idx-buy-user_id}}',
                '{{%buy}}'
            );

            $this->dropColumn('{{%buy}}', 'user_id');
        }
    }
