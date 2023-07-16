<?php

namespace app\models;

use Yii;
use yii\validators\DateValidator;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property int $user_id
 * @property int $service_id
 * @property string $date
 * @property string $address
 *
 * @property Service $service
 * @property Users $user
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'service_id', 'date', 'address'], 'required'],
            [['user_id', 'service_id'], 'integer'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['address'], 'string', 'max' => 255],
            [['date'], 'validateDateIsTomorrowOrLater'],
        ];
    }

    public function validateDateIsTomorrowOrLater($attribute, $params)
    {
        $date = $this->$attribute;
        $tomorrow = date('Y-m-d', strtotime('+1 day'));

        if ($date < $tomorrow) {
            $this->addError($attribute, 'Date must be tomorrow or later.');
        }
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'service_id' => 'Service ID',
            'date' => 'Date',
            'address' => 'Address',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}
