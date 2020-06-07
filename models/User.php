<?php

    namespace app\models;

    /**
     * This is the model class for table "user".
     *
     * @property int $id
     * @property string $phone
     * @property string $email
     */
    class User extends \yii\db\ActiveRecord
    {
        /**
         * {@inheritdoc}
         */
        public static function tableName()
        {
            return 'user';
        }

        /**
         * {@inheritdoc}
         */
        public function rules()
        {
            return [
                [['phone', 'email'], 'required'],
                [['phone', 'email'], 'string', 'max' => 255],
                [['email'], 'unique'],
                [['phone'], 'unique'],
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels()
        {
            return [
                'id' => 'ID',
                'phone' => 'Phone',
                'email' => 'Email',
            ];
        }

        /**
         * {@inheritdoc}
         * @return UserQuery the active query used by this AR class.
         */
        public static function find()
        {
            return new UserQuery(get_called_class());
        }
    }
