<?php

namespace app\modules\admin\models;

use Yii;
use app\lib\Core;
use app\lib\App;

/**
 * This is the model class for table "dlv_delivery_boy".
 *
 * @property string $deliveryBoyID
 * @property string $userID
 * @property string $name
 * @property string $emailAddress
 * @property string $phoneNumber
 * @property string $permanentAddress
 * @property string $presentAddress
 * @property string $aadharNo
 * @property integer $isEngaged
 * @property integer $isActive
 * @property integer $todayOrderCount
 * @property string $profileImagePath
 * @property string $createdDatetime
 * @property string $createdByUserID
 * @property string $modifiedDatetime
 * @property string $modifiedByUserID
 */
class DeliveryBoy extends \yii\db\ActiveRecord
{
	public $sameAsPermanentAddress;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dlv_delivery_boy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'emailAddress', 'phoneNumber', 'permanentAddress'], 'required'],
			[['presentAddress'], 'required', 'when' => function ($model) {
			    return (!$model->sameAsPermanentAddress);
			},
			'whenClient' => "function (attribute, value) {
			    return ($('input[name=\"DeliveryBoy[sameAsPermanentAddress]\"]:checked').val() == 0);
			}"],
            [['isEngaged', 'isActive', 'todayOrderCount', 'createdByUserID', 'modifiedByUserID', 'isOnDuty'], 'integer'],
            [['createdDatetime', 'modifiedDatetime', 'sameAsPermanentAddress'], 'safe'],
			[['floatingCash'], 'number'],
            [['userID'], 'string', 'max' => 10],
            [['name', 'emailAddress'], 'string', 'max' => 100],
            [['phoneNumber'], 'string', 'max' => 20],
            [['permanentAddress', 'presentAddress', 'profileImagePath'], 'string', 'max' => 255],
            [['aadharNo'], 'string', 'max' => 30],
            [['emailAddress'], 'unique'],
            [['phoneNumber'], 'unique'],
            [['userID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deliveryBoyID' => 'Delivery Boy ID',
            'userID' => 'User ID',
            'name' => 'Name',
            'emailAddress' => 'Email Address',
            'phoneNumber' => 'Phone Number',
            'permanentAddress' => 'Permanent Address',
            'presentAddress' => 'Present Address',
            'aadharNo' => 'Aadhar No',
            'isEngaged' => 'Is Engaged',
            'isActive' => 'Is Active',
            'todayOrderCount' => 'Today Order Count',
            'profileImagePath' => 'Profile Image Path',
            'createdDatetime' => 'Created Datetime',
            'createdByUserID' => 'Created By User ID',
            'modifiedDatetime' => 'Modified Datetime',
            'modifiedByUserID' => 'Modified By User ID',
			'sameAsPermanentAddress' => 'Same as Permanent Address',
        ];
    }
	
	public function beforeSave($insert)
	{
		$loggedUserDetails = Core::getLoggedUser();
        $loggedUserID = (int) $loggedUserDetails->userID;
		if($this->sameAsPermanentAddress)
		{
			$this->presentAddress = $this->permanentAddress;
		}
        
        if($this->isNewRecord) 
        {
            $this->modifiedByUserID = 0;
            $this->createdByUserID = $loggedUserID;
        }
        else 
        {
            $this->modifiedByUserID = $loggedUserID;
            $this->modifiedDatetime = App::getCurrentDateTime();
        }
        return true;
	}
	
	public function getAvailableDeliveryBoy()
	{
		$availableDeliveryBoyArr = Core::getRows("SELECT deliveryBoyID, name, emailAddress, phoneNumber, todayOrderCount FROM dlv_delivery_boy WHERE isEngaged = 0 AND isActive = 1 AND isOnDuty = 1 ORDER BY todayOrderCount ASC");
		
		return $availableDeliveryBoyArr;
	}
	
	public function createUserID($deliveryBoyID)
	{
		$userID = '';
		while($userID == '')
		{
			$newUserID = 'DSF'.rand(1000, 9999);
			$isExistsUserID = Core::getData("SELECT COUNT(deliveryBoyID) FROM dlv_delivery_boy WHERE userID = '$newUserID'");
			if($isExistsUserID == 0)
			{
				$userID = $newUserID;
			}
		}
		
		$password = App::randomPassword(6);
		$updateID = App::updateRecord('dlv_delivery_boy', array('userID' => $userID, 'password' => md5($password)), array('deliveryBoyID' => $deliveryBoyID));
		$subject = 'Registration successful';
		$body = "Your account is created successfully.\r\n";
		$body .= "Please use the below mentioned details to login and access your account\r\n\n";
		$body .= "UserID:".$userID."\r\n";
		$body .= "Password:".$password."\r\n";
		
		#$toEmailAddress = Core::getData("SELECT emailAddress FROM dlv_delivery_boy WHERE deliveryBoyID = '$deliveryBoyID'");
		App::sendMail($this->emailAddress, Yii::$app->params['fromEmail'], Yii::$app->params['fromName'], $subject, $body, 0);
		
		return true;
	}
}
