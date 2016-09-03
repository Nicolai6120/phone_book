<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property string $name
 * @property integer $create_date
 * @property integer $creator_ip
 */
class Contact extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_date',
                'updatedAtAttribute' => false,
                'value' => new Expression('UNIX_TIMESTAMP(NOW())'),
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'creator_ip'], 'required'],
            [['creator_ip'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название контакта',
            'create_date' => 'Дата создания',
            'creator_ip' => 'IP создателя',
        ];
    }

    public function getPhones()
    {
        return $this->hasMany(Phone::className(), ['contact_id'=>'id']);
    }
}
