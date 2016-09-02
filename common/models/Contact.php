<?php

namespace common\models;

use Yii;
use common\models\Phone;

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
            [['name', 'create_date', 'creator_ip'], 'required'],
            [['create_date', 'creator_ip'], 'integer'],
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
