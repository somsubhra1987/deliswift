<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "ord_order".
 *
 * @property string $orderID
 * @property string $customerID
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
 */
class Order extends \yii\db\ActiveRecord
{
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
            [['customerID', 'restaurantID', 'price', 'totalAmount'], 'required'],
            [['customerID', 'restaurantID', 'assignedDeliveryBoyID', 'orderStatus', 'ratingPoint', 'isCancelled'], 'integer'],
            [['orderDate', 'deliveredAt'], 'safe'],
            [['price', 'discount', 'totalAmount'], 'number'],
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
            'orderID' => 'Order No',
            'customerID' => 'Customer',
			'restaurantID' => 'Restaurent',
            'assignedDeliveryBoyID' => 'Assigned To',
            'orderStatus' => 'Status',
            'orderDate' => 'Date',
            'deliveredAt' => 'Delivered At',
            'price' => 'Order Amount',
            'promoCode' => 'Promo Code',
            'discount' => 'Discount',
            'totalAmount' => 'Payable Amount',
            'orderDetails' => 'Order Details',
            'ratingPoint' => 'Rating Point',
            'ratingFor' => 'Rating For',
			'isCancelled' => 'Cancelled'
        ];
    }
}
