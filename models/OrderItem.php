<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ord_item".
 *
 * @property string $orderItemID
 * @property string $orderID
 * @property string $menuItemID
 * @property integer $qty
 * @property double $price
 * @property double $discount
 * @property double $sgstPercentage
 * @property double $sgstAmount
 * @property double $cgstPercentage
 * @property double $cgstAmount
 * @property double $totalAmount
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ord_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderID', 'menuItemID', 'price', 'totalAmount'], 'required'],
            [['orderID', 'menuItemID', 'qty'], 'integer'],
            [['price', 'discount', 'sgstPercentage', 'sgstAmount', 'cgstPercentage', 'cgstAmount', 'totalAmount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderItemID' => 'Order Item ID',
            'orderID' => 'Order ID',
            'menuItemID' => 'Menu Item ID',
            'qty' => 'Qty',
            'price' => 'Price',
            'discount' => 'Discount',
            'sgstPercentage' => 'Sgst Percentage',
            'sgstAmount' => 'Sgst Amount',
            'cgstPercentage' => 'Cgst Percentage',
            'cgstAmount' => 'Cgst Amount',
            'totalAmount' => 'Total Amount',
        ];
    }
}
