<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ord_order".
 *
 * @property string $orderID
 * @property string $customerID
 * @property string $restaurantID
 * @property string $assignedDeliveryBoyID
 * @property integer $orderStatus
 * @property string $orderDate
 * @property string $deliveredAt
 * @property double $price
 * @property string $promoCode
 * @property double $discount
 * @property double $totalAmount
 * @property string $orderDetails
 * @property integer $ratingPoint
 * @property string $ratingFor
 * @property integer $isCancelled
 */
class Order extends \yii\db\ActiveRecord
{
	public $paymentMethodID, $deliveryAddressID, $cartID;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ord_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerID', 'price', 'totalAmount', 'cartID'], 'required', 'on' => 'order_create'],
			[['deliveryAddressID'], 'required', 'on' => 'order_create', 'message' => 'Please Enter delivery address'],
            [['customerID', 'restaurantID', 'assignedDeliveryBoyID', 'orderStatus', 'ratingPoint', 'isCancelled'], 'integer'],
            [['orderDate', 'deliveredAt', 'paymentMethodID'], 'safe'],
            [['price', 'discount', 'deliveryCharge', 'taxAmount', 'totalAmount'], 'number'],
            [['promoCode'], 'string', 'max' => 50],
            [['orderDetails', 'ratingFor'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderID' => 'Order ID',
            'customerID' => 'Customer ID',
            'restaurantID' => 'Restaurant ID',
            'assignedDeliveryBoyID' => 'Assigned Delivery Boy ID',
            'orderStatus' => 'Order Status',
            'orderDate' => 'Order Date',
            'deliveredAt' => 'Delivered At',
            'price' => 'Price',
            'promoCode' => 'Promo Code',
            'discount' => 'Discount',
			'deliveryCharge' => 'Delivery Charge',
			'taxAmount' => 'Tax Amount',
            'totalAmount' => 'Total Amount',
            'orderDetails' => 'Order Details',
            'ratingPoint' => 'Rating Point',
            'ratingFor' => 'Rating For',
            'isCancelled' => 'Is Cancelled',
        ];
    }
}
