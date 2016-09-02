<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phone".
 *
 * @property integer $id
 * @property integer $contact_id
 * @property string $number
 * @property integer $create_date
 * @property integer $creator_ip
 */
class Phone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact_id', 'number', 'create_date', 'creator_ip'], 'required'],
            [['contact_id', 'create_date', 'creator_ip'], 'integer'],
            [['number'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contact_id' => 'Contact ID',
            'number' => 'Number',
            'create_date' => 'Create Date',
            'creator_ip' => 'Creator Ip',
        ];
    }
}
