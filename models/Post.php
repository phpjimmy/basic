<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%t_post}}".
 *
 * @property integer $userid
 * @property string $username
 * @property string $sex
 * @property integer $age
 * @property string $password
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%t_post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'username', 'sex', 'age', 'password'], 'required','message' => '必填'],
            [['userid', 'age'], 'integer'],
            [['username'], 'string', 'max' => 15],
            [['sex'], 'string', 'max' => 1],
            [['password'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'username' => 'Username',
            'sex' => 'Sex',
            'age' => 'Age',
            'password' => 'Password',
        ];
    }
}
