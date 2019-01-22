<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cust_customer".
 *
 * @property string $customerID
 * @property string $firstName
 * @property string $lastName
 * @property string $gender
 * @property string $phoneNumber
 * @property string $emailAddress
 * @property string $password
 * @property string $lastLoginTime
 * @property integer $isMobileVerified
 * @property integer $isActive
 * @property string $verificationOTP
 * @property string $verificationOTPSentAt
 * @property string $createdByUserID
 * @property string $createdDatetime
 * @property string $modifiedByUserID
 * @property string $modifiedDatetime
 */
class Customer extends \yii\db\ActiveRecord
{
	public $confirmPassword;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cust_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'password'], 'required'],
            [['phoneNumber', 'lastName', 'lastLoginTime', 'verificationOTPSentAt', 'createdDatetime', 'modifiedDatetime', 'confirmPassword'], 'safe'],
            [['isMobileVerified', 'isActive', 'createdByUserID', 'modifiedByUserID'], 'integer'],
            [['firstName', 'lastName'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 10],
            [['phoneNumber'], 'string', 'max' => 20],
            [['emailAddress'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
            [['verificationOTP'], 'string', 'max' => 4],
			[['emailAddress'], 'required', 'on' => 'register'],
            [['emailAddress'], 'unique', 'message' => 'This email is already registered with us'],
            [['phoneNumber'], 'unique', 'message' => 'This phone number is already registered with us'],
			['confirmPassword', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match", 'on' => 'register' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customerID' => 'Customer ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'gender' => 'Gender',
            'phoneNumber' => 'Phone Number',
            'emailAddress' => 'Email Address',
            'password' => 'Password',
            'lastLoginTime' => 'Last Login Time',
            'isMobileVerified' => 'Is Mobile Verified',
            'isActive' => 'Is Active',
            'verificationOTP' => 'Verification Otp',
            'verificationOTPSentAt' => 'Verification Otpsent At',
            'createdByUserID' => 'Created By User ID',
            'createdDatetime' => 'Created Datetime',
            'modifiedByUserID' => 'Modified By User ID',
            'modifiedDatetime' => 'Modified Datetime',
        ];
    }
	
	public function beforeSave($insert)
	{
		if($this->confirmPassword != '')
		{
			$this->password = md5($this->confirmPassword);
		}
		
		return true;
	}
}
