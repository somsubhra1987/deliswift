<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_payment_info".
 *
 * @property string $paymentID
 * @property string $orderID
 * @property double $paymentAmount
 * @property string $paymentMethodID
 * @property string $paymentGatewayResponse
 * @property string $createdDatetime
 */
class PaymentInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ord_payment_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderID', 'paymentMethodID'], 'required'],
            [['orderID', 'paymentMethodID'], 'integer'],
            [['paymentAmount'], 'number'],
            [['paymentGatewayResponse'], 'string'],
            [['createdDatetime'], 'safe'],
            [['orderID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'paymentID' => 'Payment ID',
            'orderID' => 'Order ID',
            'paymentAmount' => 'Payment Amount',
            'paymentMethodID' => 'Payment Method ID',
            'paymentGatewayResponse' => 'Payment Gateway Response',
            'createdDatetime' => 'Created Datetime',
        ];
    }
}
