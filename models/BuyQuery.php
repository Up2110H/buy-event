<?php

    namespace app\models;

    /**
     * This is the ActiveQuery class for [[Buy]].
     *
     * @see Buy
     */
    class BuyQuery extends \yii\db\ActiveQuery
    {
        /*public function active()
        {
            return $this->andWhere('[[status]]=1');
        }*/

        /**
         * {@inheritdoc}
         * @return Buy[]|array
         */
        public function all($db = null)
        {
            return parent::all($db);
        }

        /**
         * {@inheritdoc}
         * @return Buy|array|null
         */
        public function one($db = null)
        {
            return parent::one($db);
        }
    }
