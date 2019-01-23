<?php

namespace app\models;

use Yii;

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
            [['customerID', 'deliveryLocationID', 'address'], 'required'],
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
        ];
    }
}
