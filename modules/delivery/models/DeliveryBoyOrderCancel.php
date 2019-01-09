<?php

namespace app\modules\delivery\models;

use Yii;

/**
 * This is the model class for table "dlv_delivery_boy_order_cancel".
 *
 * @property string $deliveryBoyOrderCancelID
 * @property string $deliveryBoyID
 * @property string $orderID
 * @property string $createdDatetime
 */
class DeliveryBoyOrderCancel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dlv_delivery_boy_order_cancel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deliveryBoyID', 'orderID'], 'required'],
            [['deliveryBoyID', 'orderID'], 'integer'],
            [['createdDatetime'], 'safe'],
            [['deliveryBoyID', 'orderID'], 'unique', 'targetAttribute' => ['deliveryBoyID', 'orderID'], 'message' => 'The combination of Delivery Boy ID and Order ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deliveryBoyOrderCancelID' => 'Delivery Boy Order Cancel ID',
            'deliveryBoyID' => 'Delivery Boy ID',
            'orderID' => 'Order ID',
            'createdDatetime' => 'Created Datetime',
        ];
    }
}
