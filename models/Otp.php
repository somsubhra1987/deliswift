<?php

namespace app\models;

use Yii;
use app\lib\App;

/**
 * This is the model class for table "php_otp".
 *
 * @property string $otpID
 * @property string $customerName
 * @property string $phoneNumber
 * @property integer $otpSent
 * @property integer $isExpired
 * @property string $useFor
 * @property string $createdDatetime
 */
class Otp extends \yii\db\ActiveRecord
{
	public $verifyOtp;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phn_otp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phoneNumber', 'otpSent', 'useFor'], 'required'],
			[['customerName'], 'required', 'on' => 'confirm_phone'],
			[['verifyOtp'], 'required', 'on' => 'verify_phone'],
			['verifyOtp', 'compare', 'compareAttribute'=>'otpSent', 'message'=>"Invalid OTP Entered", 'on' => 'verify_phone' ],
            [['otpSent', 'isExpired'], 'integer'],
            [['createdDatetime'], 'safe'],
            [['customerName', 'useFor'], 'string', 'max' => 100],
            [['phoneNumber'], 'string', 'max' => 10],
			[['verifyOtp'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'otpID' => 'Otp ID',
            'customerName' => 'Customer Name',
            'phoneNumber' => 'Phone Number',
            'otpSent' => 'Otp Sent',
            'isExpired' => 'Is Expired',
            'useFor' => 'Use For',
            'createdDatetime' => 'Created Datetime',
        ];
    }
	
	public function beforeSave($insert)
	{
		App::updateRecord('phn_otp', ['isExpired' => 1], ['phoneNumber' => $this->phoneNumber, 'isExpired' => 0, 'useFor' => 'confirm_order']);
		return true;
	}
}
