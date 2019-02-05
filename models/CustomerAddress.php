<?php

namespace app\models;

use Yii;
use app\lib\App;

/**
 * This is the model class for table "cust_customer_address".
 *
 * @property string $customerAddressID
 * @property string $customerID
 * @property string $deliveryLocationID
 * @property string $address
 * @property string $deliveryInstruction
 * @property integer $addressType
 * @property string $otherAddressType
 * @property integer $isDefault
 */
class CustomerAddress extends \yii\db\ActiveRecord
{
	public $deliveryLocation;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cust_customer_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerID', 'deliveryLocationID', 'address', 'deliveryLocation'], 'required'],
            [['customerID', 'deliveryLocationID', 'addressType', 'isDefault'], 'integer'],
            [['deliveryInstruction'], 'string'],
            [['address', 'otherAddressType'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customerAddressID' => 'Customer Address ID',
            'customerID' => 'Customer ID',
            'deliveryLocationID' => 'Delivery Location ID',
            'address' => 'Address',
            'deliveryInstruction' => 'Delivery Instruction',
            'addressType' => 'Address Type',
            'otherAddressType' => 'Other Address Type',
            'isDefault' => 'Is Default',
			'deliveryLocation' => 'Delivery Location',
        ];
    }
	
	public function beforeSave($insert)
	{
		if($this->isDefault == 1 && $this->isNewRecord)
		{
			App::updateRecord('cust_customer_address', array('isDefault' => 0), array('customerID' => $this->customerID));
			
			return true;
		}
	}
}
