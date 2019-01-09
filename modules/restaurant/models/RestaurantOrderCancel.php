<?php

namespace app\modules\restaurant\models;

use Yii;

/**
 * This is the model class for table "res_restaurant_order_cancel".
 *
 * @property string $restaurantOrderCancelID
 * @property string $restaurantID
 * @property string $orderID
 * @property string $createdDatetime
 */
class RestaurantOrderCancel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_restaurant_order_cancel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurantID', 'orderID'], 'required'],
            [['restaurantID', 'orderID'], 'integer'],
            [['createdDatetime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'restaurantOrderCancelID' => 'Restaurant Order Cancel ID',
            'restaurantID' => 'Restaurant ID',
            'orderID' => 'Order ID',
            'createdDatetime' => 'Created Datetime',
        ];
    }
}
