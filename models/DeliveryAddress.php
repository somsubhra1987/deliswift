<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ord_delivery_address".
 *
 * @property string $deliveryAddressID
 * @property string $orderID
 * @property string $customerName
 * @property string $deliveryLocation
 * @property string $cityName
 * @property string $provinceName
 * @property string $countryName
 * @property string $address
 * @property string $deliveryInstruction
 * @property integer $addressType
 * @property string $otherAddressType
 */
class DeliveryAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ord_delivery_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderID', 'address'], 'required'],
            [['orderID', 'addressType'], 'integer'],
            [['deliveryInstruction'], 'string'],
            [['customerName', 'deliveryLocation', 'address', 'otherAddressType'], 'string', 'max' => 255],
            [['cityName', 'provinceName', 'countryName'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deliveryAddressID' => 'Delivery Address ID',
            'orderID' => 'Order ID',
            'customerName' => 'Customer Name',
            'deliveryLocation' => 'Delivery Location',
            'cityName' => 'City Name',
            'provinceName' => 'Province Name',
            'countryName' => 'Country Name',
            'address' => 'Address',
            'deliveryInstruction' => 'Delivery Instruction',
            'addressType' => 'Address Type',
            'otherAddressType' => 'Other Address Type',
        ];
    }
}
