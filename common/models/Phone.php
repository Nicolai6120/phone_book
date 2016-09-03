<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

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
        return 'phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact_id', 'number'], 'required'],
            [['contact_id', 'creator_ip'], 'integer'],
            [['number'], 'string', 'max' => 32],
            [['number'], 'match', 'pattern'=>'/\+7 \(\d{3}\) \d{3} \d{2}-\d{2}/', 'message' => 'Формат телефона +7 (XXX) XXX XX-XX']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Номер',
            'create_date' => 'Дата создания',
            'creator_ip' => 'IP создателя',
        ];
    }
}
