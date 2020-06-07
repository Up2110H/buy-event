<?php

    namespace app\models;

    /**
     * This is the model class for table "buy".
     *
     * @property int $id
     * @property int $user_id
     * @property string $product
     * @property int $price
     */
    class Buy extends \yii\db\ActiveRecord
    {
        /**
         * {@inheritdoc}
         */
        public static function tableName()
        {
            return 'buy';
        }

        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                [['user_id', 'product', 'price'], 'required'],
                [['user_id', 'price'], 'integer'],
                [['product'], 'string', 'max' => 255],
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels()
        {
            return [
                'id' => 'ID',
                'user_id' => 'User ID',
                'product' => 'Product',
                'price' => 'Price',
            ];
        }

        /**
         * {@inheritdoc}
         * @return BuyQuery the active query used by this AR class.
         */
        public static function find()
        {
            return new BuyQuery(get_called_class());
        }
    }
